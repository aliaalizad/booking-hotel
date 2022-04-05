<?php

namespace App\Helpers\Booking;

use App\Models\Booking as BookingModel;
use App\Models\Passenger;
use App\Models\Payment;
use App\Models\Room;
use App\Models\Unbookable;
use App\Models\User;
use Carbon\Carbon;
use illuminate\Support\Str;

use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as ShetabitPayment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

class BookingService {

    use BookingTrait;

    private $booking;


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

        return $booking;
    }

    
    public function newBooking($booking)
    {
        $user = $booking->get('user');
        $room = $booking->get('room');
        $checkin = $booking->get('checkin');
        $checkout = $booking->get('checkout');
        $amount = $booking->get('length') * $room->price;
        $phone = $booking->get('passengers')[1]['phone'];
        $teacher = $booking->get('teacher');
        $passengers = $booking->get('passengers');


        // create booking
        $booking = BookingModel::create([
            'user_id' => $user->id,
            'room_id' => $room->id,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'amount' => $amount,
            'phone' => $phone,
            'status' => 'unpaid',
        ]);

        // add passengers
        $booking->passengers()->create($teacher);
        foreach ($passengers as $item) {
            $booking->passengers()->create($item);
        }

        return $this->booking = $booking;
    }


    public function getBooking()
    {
        return $this->booking;
    }


    public function unbookable()
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


    public function newPayment()
    {
        $amount = $this->booking->price * 1.05;


        $invoice = new Invoice;
        $invoice->amount(1000);
        // $invoice->detail([
        //     'merchant' => config('services.zibal.merchant'),
        // ]);

        return ShetabitPayment::callbackUrl(route('reserve.payment.callback'))->purchase($invoice, function($driver, $transactionId) use ($amount){

            Payment::create([
                'booking_id' => $this->booking->id,
                'amount' => $amount,
                'res' => $transactionId,
            ]);

        })->pay()->render();
    }

    public function verifyPayment()
    {
        $payment = Payment::where('res', request()->trackId)->firstOrFail();

        try {
            $receipt = ShetabitPayment::amount(1000)->transactionId($payment->res)->verify();

            // You can show payment referenceId to the user.
            echo $receipt->getReferenceId();

        } catch (InvalidPaymentException $exception) {
            /**
                when payment is not verified, it will throw an exception.
                We can catch the exception to handle invalid payments.
                getMessage method, returns a suitable message that can be used in user interface.
            **/
            echo $exception->getMessage();
        }
    }
}