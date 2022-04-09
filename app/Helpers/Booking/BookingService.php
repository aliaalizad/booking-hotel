<?php

namespace App\Helpers\Booking;

use App\Models\Booking as BookingModel;
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
        $room = $booking->get('room');
        $checkin = $booking->get('checkin');
        $checkout = $booking->get('checkout');
        $amount = $booking->get('length') * $room->price;
        $phone = $booking->get('passengers')[1]['phone'];
        $teacher = $booking->get('teacher');
        $passengers = $booking->get('passengers');

        $existing_booking = BookingModel::where([['user_id', $user->id], ['room_id', $room->id], ['checkin', $checkin], ['checkout', $checkout]])->first();
        
        if (is_null($existing_booking)) {

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

        // delete existing passengers
        $existing_booking->passengers()->delete();

        // create new passengers
        $existing_booking->passengers()->create($teacher);
        foreach ($passengers as $item) {
            $existing_booking->passengers()->create($item);
        }

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
        $beneficiary_amount = ($this->booking->amount);
        $beneficiary_account = 'IR132000300120002722448001'; // retrieve from db

        $self_amount = ($this->booking->amount) * 0.05 ;
        
        $amount = $beneficiary_amount + $self_amount;

        $invoice = new Invoice;
        $invoice->amount($amount);

        // $invoice->detail([
        //     'multiplexingInfos' => [
        //         [ 'id' => 'self', 'amount' => $self_amount],
        //         ['bankAccount' => $beneficiary_account, 'amount' => $beneficiary_amount ]
        //     ]
        // ]);

        return ShetabitPayment::callbackUrl(route('reserve.payment.callback'))->purchase($invoice, function($driver, $transactionId) use ($amount) {

            Payment::create([
                'booking_id' => $this->booking->id,
                'amount' => $amount,
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
                $voucher = rand(111111, 999999);
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