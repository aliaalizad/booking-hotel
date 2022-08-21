<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\ResourceControllerHelpers;
use App\Models\City;
use App\Models\Hotel;
use App\Models\Manager;
use Illuminate\Support\Str;

class HotelController extends Controller{

    use ResourceControllerHelpers;


    public function index()
    {
        if ( $this->panel == 'admin' ) {

            $hotels = $this->getHotels();
        
        } elseif ( $this->panel == 'manager') {

            $hotels = $this->getHotels(true);
        }

        return view('panels.' . $this->panel . '.hotels.all', compact('hotels') );
    }

    public function create()
    {
        return view('panels.' . $this->panel . '.hotels.add');
    }

    public function store(Request $request)
    {
        // set manager_id based on panel
        if ( $this->panel == 'admin' ) {
            $manager_id = $request->manager;
        }
        if ( $this->panel == 'manager' ) {
            $manager_id = $this->getCurrentManager()->id;
        }

        // first validation
        $request->validate([
            'title' => ['required', 'string', 'max:60', 'bail'],
            'phone' => ['required', 'numeric', 'digits_between:7,11' , 'bail'],
            'address' => ['required', 'string', 'max:200', 'bail'],
            'min_bookable' => ['required','integer', 'min:1', 'bail'],
            'max_bookable' => ['required','integer', 'gte:min_bookable', 'bail'],
            'bookable_until' => ['required','integer', 'min:1', 'bail'],
            'manager' => ['required', 'exists:managers,id', 'bail'],
            'longitude' => ['required', 'numeric'],
            'latitude' => ['required', 'numeric'],
        ]);

        // notification mobiles validation
        $request->validate([
            'notification_mobiles' => ['array', 'max:3'],
            'notification_mobiles.*' => ['bail', 'regex:/(09)[0-9]{9}/', 'digits:11', 'numeric', 'distinct'],
        ],[
            'notification_mobiles.array' => 'شماره موبایل نامعتبر',
            'notification_mobiles.size' => 'شماره موبایل نامعتبر',
            'notification_mobiles.*.regex' => 'شماره موبایل نامعتبر',
            'notification_mobiles.*.digits' => 'شماره موبایل نامعتبر',
            'notification_mobiles.*.numeric' => 'شماره موبایل نامعتبر',
            'notification_mobiles.*.distinct' => 'شماره موبایل تکراری',
        ]);

        // rules validation
        $request->validate([
            'rules' => ['array'],
            'rules.*' => ['string', 'max:400'],
        ],[
            'rules.array' => 'قوانین نامعتبر',
            'rules.*.string' => 'قوانین نامعتبر',
        ]);

        // set is_bookable value
        $is_bookable = is_null($request->bookable) ? 0 : 1;

        // check whether the selected city belongs to the manager state or not
        $manager = Manager::find($manager_id);

        $state = $manager->city->state;

        $cities = City::whereHas('state', function($query) use ($state) {
            $query->where('state_id', $state->id);
        })->pluck('id');

        $request->validate([
            'city' => ['required', Rule::in($cities)],
        ]);

        // add hotel
        Hotel::create([
            'code' => Str::random(20),
            'name' => $request->title,
            'phone' => $request->phone,
            'address' => $request->address,
            'city_id' => $request->city,
            'manager_id' => $manager_id,
            'is_bookable' => $is_bookable,
            'min_bookable' => $request->min_bookable,
            'max_bookable' => $request->max_bookable,
            'bookable_until' => $request->bookable_until,
            'notification_mobiles' => $request->notification_mobiles,
            'rules' => $request->rules,
            'coordinates' => [number_format($request->longitude,4), number_format($request->latitude, 4)],
        ]);

        // redirect
        return to_route( $this->panel . '.hotels.index' );
    }

    public function edit(Hotel $hotel)
    {
        $this->authorize('hotel-update', $hotel);

        return view('panels.' . $this->panel . '.hotels.edit', compact('hotel'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $this->authorize('hotel-update', $hotel);

        // first validation
        $request->validate([
            'title' => ['required', 'string', 'max:60', 'bail'],
            'phone' => ['required', 'numeric', 'digits_between:7,11' , 'bail'],
            'address' => ['required', 'string', 'max:200', 'bail'],
            'min_bookable' => ['required','integer', 'min:1', 'bail'],
            'max_bookable' => ['required','integer', 'gte:min_bookable', 'bail'],
            'bookable_until' => ['required','integer', 'min:1', 'bail'],
        ]);

        // notification mobiles validation
         $request->validate([
            'notification_mobiles' => ['array', 'max:3'],
            'notification_mobiles.*' => ['bail', 'regex:/(09)[0-9]{9}/', 'digits:11', 'numeric', 'distinct'],
        ],[
            'notification_mobiles.array' => 'شماره موبایل نامعتبر',
            'notification_mobiles.max' => 'شماره موبایل نامعتبر',
            'notification_mobiles.*.regex' => 'شماره موبایل نامعتبر',
            'notification_mobiles.*.digits' => 'شماره موبایل نامعتبر',
            'notification_mobiles.*.numeric' => 'شماره موبایل نامعتبر',
            'notification_mobiles.*.distinct' => 'شماره موبایل تکراری',
        ]);

        // rules validation
        $request->validate([
            'rules' => ['array'],
            'rules.*' => ['string', 'max:400'],
        ],[
            'rules.array' => 'قوانین نامعتبر',
            'rules.*.string' => 'قوانین نامعتبر',
        ]);

        // set is_bookable value
        $is_bookable = is_null($request->bookable) ? 0 : 1;

        // update hotel
        $hotel->update([
            'name' => $request->title,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_bookable' => $is_bookable,
            'min_bookable' => $request->min_bookable,
            'max_bookable' => $request->max_bookable,
            'bookable_until' => $request->bookable_until,
            'notification_mobiles' => $request->notification_mobiles,
            'rules' => $request->rules,
        ]);

        // redirect
        return to_route($this->panel . '.hotels.index');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return to_route($this->panel . '.hotels.index');
    }

}