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

        } elseif ( $this->panel == 'manager') {

            $members = $this->getMembers(true);

        }

        return view('panels.' . $this->panel . '.members.all', compact('members') );
    }

    public function create()
    {
        $managers = null;
        $hotels = null;

        if ( $this->panel == 'admin' ) {
            $managers = $this->getAllManagers();
            $hotels = $this->getAllHotels();
        }

        return view('panels.' . $this->panel . '.members.add', compact('managers', 'hotels'));
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

        // set manager_id value
        if ( $this->panel == 'admin' ) {

            // manager validation
            $request->validate([
                'manager' => ['required', Rule::exists('managers', 'id')],
            ]);
            $manager_id = $request->manager;

        }  elseif ( $this->panel == 'manager') {
            $manager_id = $this->getCurrentManager()->id;
        }
        
        // set hotel_id value
        $hotel_id = null;
        if ( is_null($request->hotel) ) {

            // checks is hotel for selected manager or not
            if ( Hotel::find($request->hotel)->manager_id != $manager_id ) {
                return back()->withInput()->withErrors([
                    'invalidHotel' => 'selected hotel is not for selected manager'
                ]);
            }
            $hotel_id = $request->hotel;
        }

        // set is_blocked value
        $is_blocked = is_null($request->status) ? 1 : 0;

        // create new member
        Member::create([
            'name' => $request->name,
            'personnel_code' => $request->personnel_code,
            'password' => Hash::make($request->password),
            'is_blocked' => $is_blocked,
            'manager_id' => $manager_id,
            'hotel_id' => $hotel_id,
        ]);

        // redirect to index
        return to_route( $this->panel . '.members.index');
    }


    public function edit(Member $member)
    {
        $managers = null;
        $hotels = null;

        if ( $this->panel == 'admin' ) {
            $managers = $this->getAllManagers();
            $hotels = $this->getAllHotels();
        }

        return view( 'panels.' . $this->panel . '.members.edit', compact('member', 'managers', 'hotels'));

    }


    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => ['required'],
            'personnel_code' => ['required', Rule::unique('members', 'personnel_code')->ignore($member->id) ],
            'phone' => ['required', Rule::unique('members', 'phone')->ignore($member->id) ],
            'status' => ['boolean'],
        ]);

        // set manager_id value
        if ( $this->panel == 'admin' ) {
            // manager validation
            $request->validate([
                'manager' => ['required', Rule::exists('managers', 'id')],
            ]);
            $manager_id = $request->manager;

        }  elseif ( $this->panel == 'manager') {
            $manager_id = $this->getCurrentManager()->id;
        }

        // set hotel_id value
        $hotel_id = null;
        if ( ! is_null($request->hotel) ) {
            // checks is hotel for selected manager or not
            if ( Hotel::find($request->hotel)->manager_id != $manager_id ) {
                return back()->withInput()->withErrors([
                    'invalidHotel' => 'invalid hotel'
                ]);
            }
            $hotel_id = $request->hotel;
        }

        // set is_blocked value
        $is_blocked = is_null($request->status) ? 1 : 0;

        // update data
        $member->update([
            'name' => $request->name,
            'personnel_code' => $request->personnel_code,
            'phone' => $request->phone,
            'is_blocked' => $is_blocked,
            'manager_id' => $manager_id,
            'hotel_id' => $hotel_id,
        ]);

        // update password
        if ( ! is_null($request->current_password) || ! is_null($request->password) || ! is_null($request->password_confirmation) ) {
            
            $request->validate([
                'current_password' => ['required'],
                'password' => ['required'],
                'password_confirmation' => ['required'],
            ]);

            if ( Hash::check($request->current_password, $member->password) ) {
                $request->validate([
                    'password' => ['confirmed'],
                ]);
                $member->update([
                    'password' => Hash::make($request->password),
                ]); 

            } else {
                return back()->withInput()->withErrors([
                    'invalidCurrentPasword' => 'current password is invalid'
                ]);
            }
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