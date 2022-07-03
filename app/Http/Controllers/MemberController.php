<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\ResourceControllerHelpers;
use App\Models\Hotel;
use Illuminate\Support\Facades\Gate;

class MemberController  extends Controller {

    use ResourceControllerHelpers;


    public function index()
    {

        if ( $this->panel == 'admin' ) {

            $members = $this->getMembers();

        } elseif ( $this->panel == 'manager' ) {

            $members = $this->getMembers(true);
        }

        return view('panels.' . $this->panel . '.members.all', compact('members') );
    }

    public function create()
    {
        if ( $this->panel == 'admin' ) {

            $hotels = $this->getHotels();

        } elseif ( $this->panel == 'manager' ) {

            $hotels = $this->getHotels(true);
        }

        return view('panels.' . $this->panel . '.members.add', compact('hotels'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'personnel_code' => ['required','unique:members,personnel_code'],
            'phone' => ['required', 'unique:members,phone'],
            'password' => ['required', 'confirmed'],
            'status' => ['boolean'],
        ]);
        
        if ( $this->panel == 'admin' ) {

            $hotel = Hotel::findOrFail($request->hotel);

        } elseif ( $this->panel == 'manager' ) {

            $hotel = Hotel::where('id', $request->hotel)->where('manager_id', $this->getCurrentManager()->id)->firstOrFail();
        }

        // set is_blocked value
        $is_blocked = is_null($request->status) ? 1 : 0;

        // create new member
        Member::create([
            'name' => $request->name,
            'personnel_code' => $request->personnel_code,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'is_blocked' => $is_blocked,
            'manager_id' => $hotel->manager_id,
            'hotel_id' => $hotel->id,
        ]);

        // redirect to index
        return to_route( $this->panel . '.members.index');
    }


    public function edit(Member $member, Request $request)
    {
        if ( $this->panel == 'admin' ) {

            $hotels = $this->getHotels();

        } elseif ( $this->panel == 'manager' ) {

            $hotels = $this->getHotels(true);
        }

        $panel = $this->panel;

        return view( 'panels.' . $this->panel . '.members.edit', compact('member', 'hotels', 'panel'));

    }


    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => ['required'],
            'personnel_code' => ['required', Rule::unique('members', 'personnel_code')->ignore($member->id) ],
            'phone' => ['required', Rule::unique('members', 'phone')->ignore($member->id) ],
            'status' => ['boolean'],
        ]);

        if ( $this->panel == 'admin' ) {

            $hotel = Hotel::findOrFail($request->hotel);

        } elseif ( $this->panel == 'manager' ) {

            $hotel = Hotel::where('id', $request->hotel)->where('manager_id', $this->getCurrentManager()->id)->firstOrFail();
        }

        // set is_blocked value
        $is_blocked = is_null($request->status) ? 1 : 0;

        // update data
        $member->update([
            'name' => $request->name,
            'personnel_code' => $request->personnel_code,
            'phone' => $request->phone,
            'is_blocked' => $is_blocked,
            'manager_id' => $hotel->manager_id,
            'hotel_id' => $hotel->id,
        ]);


        // update password
        if ( ! is_null($request->current_password) || ! is_null($request->password) || ! is_null($request->password_confirmation) ) {

            $request->validate([
                'password' => ['required', 'confirmed'],
            ]);

            if ( $this->panel == 'member' ) {
                $request->validate([
                    'current_password' => ['required'],
                ]);

                if ( ! Hash::check($request->current_password, $member->password) ) {
                    return back()->withInput()->withErrors([
                        'invalidCurrentPasword' => 'current password is invalid'
                    ]);
                }
            }

            $member->update([
                'password' => Hash::make($request->password),
            ]); 
        }


        // redirect to index
        return to_route($this->panel . '.members.index');
    }


    public function destroy(Member $member)
    {
        if ($member->hotel_id != null) {
            return back()->withErrors(['deleteError' => 'this member has been assigned to ' . $member->hotel->name . ' first remove from hotel']);
        }

        $member->delete();

        return to_route($this->panel . '.members.index');
    }

}