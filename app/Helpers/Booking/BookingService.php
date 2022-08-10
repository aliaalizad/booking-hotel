<?php

namespace App\Helpers\Booking;

use App\Models\Booking as BookingModel;
use App\Models\Payment;
use App\Models\Room;
use App\Models\Unbookable;
use Carbon\Carbon;
use illuminate\Support\Str;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as ShetabitPayment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

class BookingService {

    use BookingTrait;


    public function putBookingToSession()
    {
        $id = Str::random(40);

        session()->push('bookings', collect([
                'id' => $id,
                'user' => user('web'),
                'room' => Booking::getRoom(),
                'checkin' => Booking::getCheckin(),
                'checkout' => Booking::getCheckout(),
                'checkinJalali' => Booking::getCheckinJalali(),
                'checkoutJalali' => Booking::getCheckoutJalali(),
                'length' => Booking::getLength(),
                'adults' => Booking::getAdults(),
                'teacher' => Booking::getTeacher(),
                'passengers' => Booking::getPassengers(),
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
        $room = $booking->get('room');
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


        $this->room_number = $this->getValidRoomNumbers($room)->first();


        // create booking
        $booking = BookingModel::create([
            'user_id' => $user->id,
            'room_id' => $room->id,
            'room_number' => $this->room_number,
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


    public function freezeRoom()
    {
        $user_id = $this->booking->user_id;
        $room_id = $this->booking->room_id;
        $start_date = $this->booking->checkin;
        $end_date = $this->booking->checkout;
        $expiration = Carbon::now()->addMinutes(10);

        $unbookable = Unbookable::where([['user_id', $user_id], ['start_date', $start_date], ['end_date', $end_date], ['expiration', '>=', Carbon::now()]])->first();

        if (is_null($unbookable)) {
            Unbookable::create([
                'user_id' => $user_id,
                'room_id' => $room_id,
                'room_number' => $this->room_number,
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
        $room_number = $booking->room_number;

        $unbookable = Unbookable::where([['user_id', $user_id], ['room_id', $room_id], ['room_number', $room_number], ['start_date', $start_date], ['end_date', $end_date]])->first();

        if ($unbookable) {
            $unbookable->delete();
        }
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

    
        $invoice->detail([
/*
            'multiplexingInfos' => [
                [ 'id' => 'self', 'amount' => $self_amount],
                ['bankAccount' => $manager_account, 'amount' => $manager_amount ]
            ],
*/
        ]);




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
        $track_id = request()->Authority; // zarinpal
        // $track_id = request()->track_id; // zibal


        $payment = Payment::where('track_id', $track_id)->firstOrFail();

        try {   
            $receipt = ShetabitPayment::amount($payment->amount)->transactionId($payment->track_id)->verify();

            $this->defreezeRoom($payment->booking_id); // it is important to be at the top of the code

            $payment->update([
                'status' => 1,
            ]);

            if (is_null($payment->booking->voucher)) {
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
            }

            return to_route('user.profile')->with('payment_status',1);

        } catch (InvalidPaymentException $exception) {

            $this->defreezeRoom($payment->booking_id); // it is important to be at the top of the code

            return to_route('user.profile')->with('payment_status',0);
        }

    }

}