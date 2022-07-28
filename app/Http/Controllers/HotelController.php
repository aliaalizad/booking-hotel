<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\ResourceControllerHelpers;
use App\Models\City;
use App\Models\Hotel;
use App\Models\Manager;
use App\Models\Member;
use App\Models\Room;
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
        // Set manager_id based on panel
        if ( $this->panel == 'admin' ) {
            $manager_id = $request->manager;
        }
        if ( $this->panel == 'manager' ) {
            $manager_id = $this->getCurrentManager()->id;
        }

        // First validation
        $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required'],
            'address' => ['required', 'string'],
            'manager' => ['exists:managers,id'],
            'min_bookable' => ['required', 'integer', 'min:1'],
            'max_bookable' => ['required', 'integer', 'gte:min_bookable'],
            'bookable_until' => ['required', 'integer', 'min:1'],
        ]);

        // set is_bookable value
        $is_bookable = is_null($request->bookable) ? 0 : 1;

        // Check whether the selected city belongs to the manager state or not
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
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city_id' => $request->city,
            'manager_id' => $manager_id,
            'is_bookable' => $is_bookable,
            'min_bookable' => $request->min_bookable,
            'max_bookable' => $request->max_bookable,
            'bookable_until' => $request->bookable_until,
        ]);

        return to_route( $this->panel . '.hotels.index' );
    }


    public function edit(Hotel $hotel)
    {
        return view('panels.' . $this->panel . '.hotels.edit', compact('hotel'));
    }


    public function update(Request $request, Hotel $hotel)
    {
        // First validation
        $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required'],
            'address' => ['required', 'string'],
            'min_bookable' => ['required', 'integer', 'min:1'],
            'max_bookable' => ['required', 'integer', 'gte:min_bookable'],
            'bookable_until' => ['required', 'integer', 'min:1'],
        ]);

        // set is_bookable value
        $is_bookable = is_null($request->bookable) ? 0 : 1;

        // Update hotel
        $hotel->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_bookable' => $is_bookable,
            'min_bookable' => $request->min_bookable,
            'max_bookable' => $request->max_bookable,
            'bookable_until' => $request->bookable_until,            
        ]);

        // Redirect
        return to_route($this->panel . '.hotels.index');
    }


    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return to_route($this->panel . '.hotels.index');
    }

}