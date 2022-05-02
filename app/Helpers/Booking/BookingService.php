<?php

namespace App\Helpers\Booking;

use App\Models\Booking as BookingModel;
use App\Models\Manager;
use App\Models\Passenger;
use App\Models\Payment;
use App\Models\Room;
use App\Models\Unbookable;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use illuminate\Support\Str;

use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as ShetabitPayment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

class BookingService {

    use BookingTrait;


    public function putBookingToSession()
    {
        $id = Str::random(40);
        $user = auth('web')->user();
        $room = Booking::getRoom();
        $checkin = Booking::getCheckin();
        $checkinJalali = Booking::getCheckinJalali();
        $checkout = Booking::getCheckout();
        $checkoutJalali = Booking::getCheckoutJalali();
        $length = Booking::getLength();
        $adults = Booking::getAdults();
        $teacher = Booking::getTeacher();
        $passengers = Booking::getPassengers();


        
        session()->push('bookings', collect([
                'id' => $id,
                'user' => $user,
                'room' => $room,
                'checkin' => $checkin,
                'checkout' => $checkout,
                'checkinJalali' => $checkinJalali,
                'checkoutJalali' => $checkoutJalali,
                'length' => $length,
                'adults' => $adults,
                'teacher' => $teacher,
                'passengers' => $passengers,
            ])
        );

        $booking = collect(session()->get('bookings'))->where('id', $id)->first();

        return $booking;
    }


    public function pullBookingFromSession($booking)
    {
        $booking = collect(collect(session()->get('bookings'))->where('id', $booking)->first());
        
        if ($booking->isEmpty()) {
            abort(404);
        }

        $this->checkin = $booking->get('checkin');
        $this->checkout = $booking->get('checkout');

        return $booking;
    }


    public function newBooking($booking)
    {
        $user = $booking->get('user');
        $room = Room::find($booking->get('room')->id);
        $checkin = $booking->get('checkin');
        $checkout = $booking->get('checkout');
        $amount = $booking->get('length') * $room->price;
        $teacher = $booking->get('teacher');
        $passengers = $booking->get('passengers');


        $teacher = [
            'teacher' => [
                'name' => $teacher['first_name'] . ' ' . $teacher['last_name'],
                'personnel_code' => $teacher['personnel_code'],
                'national_code' => $teacher['national_code'],
            ]
        ];

        $head = [
            'head' => [
                'name' => $passengers[1]['first_name'] . ' ' . $passengers[1]['last_name'],
                'national_code' => $passengers[1]['national_code'],
                'phone' => $passengers[1]['phone'],
            ],
        ];
        
        $i=1;
        foreach ($passengers as $passenger) {
            $_passengers['passengers'][$i] = [
                'name' => $passenger['first_name'] . ' ' . $passenger['last_name'],
                'national_code' => $passenger['national_code'],
            ];
            $i++;
        }

        $detail = array_merge($teacher, $head, $_passengers);

        $existing_booking = BookingModel::where([['user_id', $user->id], ['room_id', $room->id], ['checkin', $checkin], ['checkout', $checkout]])->first();

        if (is_null($existing_booking)) {

            // create booking
            $booking = BookingModel::create([
                'user_id' => $user->id,
                'room_id' => $room->id,
                'checkin' => $checkin,
                'checkout' => $checkout,
                'amount' => $amount,
                'status' => 'unpaid',
            ]);
        

            // add passengers
            $booking->passengers()->create([
                'detail' => $detail
            ]);


            return $this->booking = $booking;
        }

        // update booking
        $existing_booking->update([
            'amount' => $amount,
        ]);

        // delete existing passengers
        $existing_booking->passengers()->delete();
        // create new passengers
        $existing_booking->passengers()->create([
            'detail' => $detail
        ]);

        return $this->booking = $existing_booking;
    }


    public function freezeRoom()
    {
        $user_id = $this->booking->user_id;
        $room_id = $this->booking->room_id;
        $start_date = $this->booking->checkin;
        $end_date = $this->booking->checkout;
        $expiration = Carbon::now()->addMinutes(15);

        $unbookable = Unbookable::where([['user_id', $user_id], ['start_date', $start_date], ['end_date', $end_date], ['expiration', '>=', Carbon::now()]])->first();

        if (is_null($unbookable)) {
            Unbookable::create([
                'user_id' => $user_id,
                'room_id' => $room_id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'expiration' => $expiration,
            ]);
        }

    }


    public function defreezeRoom($booking_id)
    {
        $booking = BookingModel::findOrFail($booking_id);

        $user_id = $booking->user_id;
        $room_id = $booking->room_id;
        $start_date = $booking->checkin;
        $end_date = $booking->checkout;

        $unbookable = Unbookable::where([['user_id', $user_id], ['room_id', $room_id], ['start_date', $start_date], ['end_date', $end_date]])->firstOrFail();

        $unbookable->delete();
    }


    public function newPayment()
    {
        $room = Room::find($this->booking->room->id);

        $manager_account = ($room->hotel->manager->bank_account);
        $commission = ($room->hotel->manager->commission);

        $manager_amount = ($this->booking->amount);
        $self_amount = ($this->booking->amount) * (($commission)/100);
        $payment_amount = $this->booking->amount + $self_amount;

        $invoice = new Invoice;
        $invoice->amount($payment_amount);

        // $invoice->detail([
        //     'multiplexingInfos' => [
        //         [ 'id' => 'self', 'amount' => $self_amount],
        //         ['bankAccount' => $manager_account, 'amount' => $manager_amount ]
        //     ]
        // ]);

        return ShetabitPayment::callbackUrl(route('reserve.payment.callback'))->purchase($invoice, function($driver, $transactionId) use ($payment_amount, $manager_amount) {

            Payment::create([
                'booking_id' => $this->booking->id,
                'amount' => $payment_amount,
                'booking_amount' => $manager_amount,
                'track_id' => $transactionId,
            ]);

        })->pay()->render();
    }


    public function verifyPayment()
    {
        $payment = Payment::where('track_id', request()->trackId)->firstOrFail();

        try {
            $receipt = ShetabitPayment::amount($payment->amount)->transactionId($payment->track_id)->verify();

            $this->defreezeRoom($payment->booking_id); // it is important to be at the top of the code

            $payment->update([
                'status' => 1,
            ]);


            while(1) {
                $voucher = rand(11111111, 99999999);
                if (! BookingModel::where('voucher', $voucher)->exists()){
                    break;
                }
            }
            $payment->booking()->update([
                'voucher' => $voucher,
                'status' => 'paid',
            ]);


        } catch (InvalidPaymentException $exception) {

            $this->defreezeRoom($payment->booking_id); // it is important to be at the top of the code

            echo 'پرداخت با خطا مواجه شد. در صورتی که مبلغ از حساب شما برداشت شده حداکثر تا 72 ساعت به حساب شما باز خواهد گشت';
        }
    }

}