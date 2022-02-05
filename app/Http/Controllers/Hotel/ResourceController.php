<?php

namespace App\Http\Controllers\Hotel;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\ResourceControllerHelpers;
use App\Models\Hotel;
use App\Models\Member;

class ResourceController {

    use ResourceControllerHelpers;


    public function index()
    {
        if ( $this->guard == 'admin' ) {
            $hotels = $this->getAllHotels();
        
        } elseif ( $this->guard == 'manager') {
            $hotels = $this->getCurrentManager()->hotels;
        }

        return view($this->guard . '.hotels', compact('hotels') );
    }

    public function create()
    {
        if ( $this->guard == 'manager' ) {
            $members = $this->getCurrentManager()->members->where('hotel_id', null);
        }

        return view($this->guard . '.add-hotel', compact('members') );
    }


    public function store(Request $request)
    {
        if ($request->members == null) {
            return back()->withErrors(['members' => 'باید حداقل 1 کارمند را انتخاب کنید']);
        }

        $request->validate([
            'name' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],
            'city' => ['required'],
            'members' => ['required'],
        ]);

        if ( $this->guard == 'manager' ) {

            $manager_id = $this->getCurrentManager()->id;

            $request->validate([
            'members.*' => ['required', 'distinct', Rule::exists('members', 'id')->where('manager_id', $manager_id)->where('hotel_id', null)],
            ]);
        }

        // add hotel
        $hotel = Hotel::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'manager_id' => $manager_id,
        ]);

         // update member
         foreach ( $request->members as $id ) {
            $member = Member::find($id);
            $member->hotel_id = $hotel->id;
            $member->save();
        }

        return redirect()->route( $this->guard . '.hotels.index');
    }


    public function edit(Hotel $hotel)
    {
        $manager = $this->getCurrentManager();

        if ( $hotel->manager_id != $manager->id ) {
            abort(404);
        }

        $hotel_members = Member::where([['manager_id', $manager->id], ['hotel_id', $hotel->id]])->get();
        $available_members = Member::where([['manager_id', $manager->id], ['hotel_id', null]])->get();

        return view( $this->guard . '.hotel', compact('hotel', 'hotel_members', 'available_members'));

    }


    public function update(Request $request, Hotel $hotel)
    {

        if ($request->members == null) {
            return back()->withErrors(['members' => 'باید حداقل 1 کارمند را انتخاب کنید']);
        }

        $request->validate([
            'name' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],
            'city' => ['required'],
            'members' => ['required'],
        ]);

        if ( $this->guard == 'manager' ) {

            $manager_id = $this->getCurrentManager()->id;

            $request->validate([
                'members.*' => ['required', 'distinct', Rule::exists('members', 'id')->where('manager_id', $manager_id)->where(function ($query) use ($hotel) {
                    return $query->where('hotel_id', $hotel->id)->orWhere('hotel_id', null);
                })]
            ]);
        }

        $hotel->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
        ]);


        // remove old members form hotel
        foreach ( $hotel->members as $member ) {
            $member->hotel_id = null;
            $member->save();
        }
        // add new members form hotel
        foreach ( $request->members as $id ) {
            $member = Member::find($id) ;
            $member->hotel_id = $hotel->id;
            $member->save();
        }

        return redirect()->route($this->guard .  '.hotels.index');
    }


    public function destroy(Hotel $hotel)
    {
        foreach ( $hotel->members as $member ) {
            $member->hotel_id = null;
            $member->save();
        }

        $hotel->delete();
        
        return redirect()->route($this->guard . '.hotels.index');
    }

}