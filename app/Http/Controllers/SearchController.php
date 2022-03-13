<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        return view('search');
        [ $checkin, $checkout, $adults ] = $this->validator($request);

        $rooms = $this->search($checkin, $checkout, $adults);

        dd($rooms);
    }

    public function validator(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'checkin' => ['required'],
            'checkout' => ['required'],
            'adults' => ['required'],
        ])->validated();

        $validator = Validator::make($request->all(), [
            'checkin' => ['required', 'date_format:Y-m-d', 'after_or_equal:today'],
            'checkout' => ['required', 'date_format:Y-m-d', 'after:today', 'after:checkin'],
            'adults' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {

            $failedRules = $validator->failed();

            // checkin and checkout
            if( isset($failedRules['checkin']) ) {
                if( isset($failedRules['checkout'])) {
                    $checkin = Carbon::now()->toDateString();
                    $checkout = Carbon::now()->addDay()->toDateString();
                } else {
                    $checkin = Carbon::now()->toDateString();
                    $checkout = $request->checkout;
                }
            } else {
                $checkin = Carbon::create($request->checkin)->toDateString();
                $checkout = Carbon::create($request->checkin)->addDay()->toDateString();
            }

            // adults
            if (isset($failedRules['adults'])) {
                $adults = 2;
            } else {
                $adults = $request->adults;
            }

        } else {
            $checkin = $request->checkin;
            $checkout = $request->checkout;
            $adults = $request->adults;
        }

        return [ $checkin, $checkout, $adults ];
    }

    public function search($checkin, $checkout, $adults)
    {
        $rooms = Room::where('capacity', '>=', $adults)
            ->whereDoesntHave('bookings', function ($query) use ($checkin, $checkout) {
                $query->where([['checkin', '>=', $checkin], ['checkin', '<', $checkout]])
                    ->orWhere([['checkout', '>', $checkin], ['checkout', '<=', $checkout]])
                    ->orWhere([['checkin', '<', $checkin], ['checkout', '>', $checkout]]);
            })
            ->get();

        return $rooms;
    }

}
