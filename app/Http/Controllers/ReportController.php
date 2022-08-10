<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use TCPDF;

class ReportController extends Controller
{
    public function pdfReport()
    {

        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('KhaneReserve');
        $pdf->SetTitle('KhaneReserve');
        $pdf->SetSubject('KhaneReserve Report');
        $pdf->SetKeywords('');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 14, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // Set some content to print
        $html = <<<EOD
        <h1>ُلام عرض می کنم خدمت  to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
        <i>This is the first example of TCPDF library.</i>
        <p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
        <p>Please check the source code documentation and other examples for further information.</p>
        <p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
        EOD;

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('report.pdf', 'I');
    }

    public function bookings()
    {
        if ($this->panel == 'admin') {
            $bookings = Booking::cursor();
        }

        if ($this->panel == 'manager') {
            $bookings = user('manager')->hotels->flatMap(function($hotel){
                return $hotel->rooms;
            })->lazy()->flatMap(function($room) {
                return $room->bookings;
            });    
        }

        if ($this->panel == 'member') {
            $bookings = user('member')->hotel->rooms->lazy()->flatMap(function($room) {
                return $room->bookings;
            });
        }

        return $bookings;
    }

    public function payments()
    {
        $payments = $this->bookings()->flatMap(function($booking){
            return $booking->payments->where('status', 1);
        });

        return $payments;
    }
 
    public function incomes()
    {
        $payments = $this->payments();

        if ($this->panel == 'admin') {
            $incomes = $payments->map(function($payment){
                return [
                    'date' => verta($payment->created_at),
                    'amount' => ($payment->amount - $payment->booking_amount),
                    'hotel' => $payment->booking->room->hotel->id,
                ];
            });
        }

        if ($this->panel == 'manager' || $this->panel == 'member') {
            $incomes = $payments->map(function($payment){
                return [
                    'date' => verta($payment->created_at),
                    'amount' => $payment->booking_amount,
                    'hotel' => $payment->booking->room->hotel->id,
                ];
            });
        }

        return $incomes;
    }

    public function dailyIncome()
    {
        $incomes = $this->incomes()->groupBy(function($income) {
            return verta()->parse($income['date'])->format('Y/m/d');
        })->map(function($income, $key){
            return [
                'date' => $key,
                'amount' => $income->sum('amount'),
            ];
        });

        return $incomes;
    }

    public function dailyIncomeList()
    {
        $incomes = $this->dailyIncome()->sortByDesc('date');

        return view('panels.' . $this->panel . '.reports.dailyIncomeList', compact('incomes'));
    }

    public function monthlyIncome()
    {
        $incomes = $this->incomes()->groupBy(function($income) {
            return verta()->parse($income['date'])->format('Y/m');
        })->map(function($income, $key){
            return [
                'date' => $key,
                'amount' => $income->sum('amount'),
            ];
        });

        return $incomes;
    }

    public function monthlyIncomeList()
    {
        $incomes = $this->monthlyIncome()->sortByDesc('date');;

        return view('panels.' . $this->panel . '.reports.monthlyIncomeList', compact('incomes'));
    }

    public function incomeAnalysis()
    {
        // جمع کل درآمد
        $total_income = $this->incomes()->sum('amount');

        // درآمد ماه فعلی
        if (count( $this->monthlyIncome()->where('date', verta()->format('Y/m')) ) == 0) {
            $this_month_income = 0;
        } else {
            $this_month_income = $this->monthlyIncome()->where('date', verta()->format('Y/m'))->first()['amount'];
        }

        // درآمد ماه گذشته
        if (count( $this->monthlyIncome()->where('date', verta()->subMonth()->format('Y/m')) ) == 0) {
            $last_month_income = 0;
        } else {
            $last_month_income = $this->monthlyIncome()->where('date', verta()->subMonth()->format('Y/m'))->first()['amount'];
        }

        // درصد تغییر درآمد ماهانه
        if ($this_month_income == 0 && $last_month_income == 0) {
            $monthly_income_change_percentage = 0;
        } elseif ($this_month_income == 0) {
            $monthly_income_change_percentage = -100;
        } elseif ($last_month_income == 0) {
            $monthly_income_change_percentage = null;
        } else {
            $monthly_income_change_percentage = number_format(( $this_month_income - $last_month_income ) / $last_month_income * 100) ;
        }

        // میانگین درآمد ماهانه
        $avg_monthly_income = $this->monthlyIncome()->avg('amount');
        // پردرآمدترین ماه
        $max_monthly_income = $this->monthlyIncome()->where('amount', $this->monthlyIncome()->max('amount'))->sortBy('date')->first();


        // درآمد هفته فعلی
        $this_week_income = $this->dailyIncome()->whereBetween('date', [verta()->startWeek()->format('Y/m/d'), verta()->endWeek()->format('Y/m/d')])->sum('amount');
        // درآمد هفته گذشته
        $last_week_income = $this->dailyIncome()->whereBetween('date', [verta()->subWeek()->startWeek()->format('Y/m/d'), verta()->subWeek()->endWeek()->format('Y/m/d')])->sum('amount');

        // درصد تغییر درآمد هفتگی
        if ($this_week_income == 0 && $last_week_income == 0) {
            $weekly_income_change_percentage = 0;
        } elseif ($this_week_income == 0) {
            $weekly_income_change_percentage = -100;
        } elseif ($last_week_income == 0) {
            $weekly_income_change_percentage = null;
        } else {
            $weekly_income_change_percentage = number_format(( $this_week_income - $last_week_income ) / $last_week_income * 100) ;
        }


        // درآمد امروز
        if (count( $this->dailyIncome()->where('date', verta()->format('Y/m/d')) ) == 0) {
            $today_income = 0;
        } else {
            $today_income = $this->dailyIncome()->where('date', verta()->format('Y/m/d'))->first()['amount'];
        }

        // درآمد دیروز
        if (count( $this->dailyIncome()->where('date', verta()->subDay()->format('Y/m/d')) ) == 0) {
            $yesterday_income = 0;
        } else {
            $yesterday_income = $this->dailyIncome()->where('date', verta()->subDay()->format('Y/m/d'))->first()['amount'];
        }

        // درصد تغییر درآمد روزانه
        if ($today_income == 0 && $yesterday_income == 0) {
            $daily_income_change_percentage = 0;
        } elseif ($today_income == 0) {
            $daily_income_change_percentage = -100;
        } elseif ($yesterday_income == 0) {
            $daily_income_change_percentage = null;
        } else {
            $daily_income_change_percentage = number_format(( $today_income - $yesterday_income ) / $yesterday_income * 100) ;
        }
 
        // میانگین درآمد روزانه
        $avg_daily_income = $this->dailyIncome()->avg('amount');
         // پردرآمدترین روز
        $max_daily_income = $this->dailyIncome()->where('amount', $this->dailyIncome()->max('amount'))->sortBy('date')->first();



        $data = [
            'total_income' => $total_income,
            'this_month_income' => $this_month_income,
            'this_week_income' => $this_week_income,
            'today_income' => $today_income,
            'monthly_income_change_percentage' => $monthly_income_change_percentage,
            'weekly_income_change_percentage' => $weekly_income_change_percentage,
            'daily_income_change_percentage' => $daily_income_change_percentage,
            'avg_daily_income' => $avg_daily_income,
            'max_daily_income' => $max_daily_income,
            'avg_monthly_income' => $avg_monthly_income,
            'max_monthly_income' => $max_monthly_income,
        ];

        return view('panels.' . $this->panel . '.reports.incomeAnalysis', compact('data'));
    }
}
