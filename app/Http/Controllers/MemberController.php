<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\ResourceControllerHelpers;
use App\Models\Hotel;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Validation\Rules\Password;

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
        // validation
        $request->validate([
            'name' => ['bail', 'required', 'string', 'max:40'],
            'username' => ['bail', 'required','unique:members,username', 'string', 'between:5,10'],
            'mobile' => ['bail', 'required', 'unique:members,phone', 'regex:/(09)[0-9]{9}/', 'numeric', 'digits:11'],
            'password' => ['bail', 'required', Password::min(8)->letters()->numbers(), 'confirmed'],
            'hotel' => ['required'],
        ]);
        
        if ( $this->panel == 'admin' ) {

            $hotel = Hotel::findOrFail($request->hotel);

        } elseif ( $this->panel == 'manager' ) {

            $hotel = Hotel::where('id', $request->hotel)->where('manager_id', $this->getCurrentManager()->id)->firstOrFail();
        }

        // set is_blocked value
        $is_blocked = is_null($request->status) ? 1 : 0;

        // create
        $member = Member::create([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->mobile,
            'password' => Hash::make($request->password),
            'is_blocked' => $is_blocked,
            'manager_id' => $hotel->manager_id,
            'hotel_id' => $hotel->id,
        ]);


        // roles & permissions
        if (isset($request->roles)) {

            $request->validate([
                'roles' => ['required', 'array'],
            ]);

            foreach ($request->roles as $role) {
                $role_guard = Role::find($role)->guard;

                if ( $role_guard != 'member' ) {
                    return redirect()->back()->withErrors('نقش انتخابی اشتباه است.');
                }
            }
        }

        if (isset($request->permissions)) {

            $request->validate([
                'permissions' => ['required', 'array'],
            ]);

            foreach ($request->permissions as $permission) {
                $permission_guard = Permission::find($permission)->guard;
    
                if ( $permission_guard != 'member' ) {
                    return redirect()->back()->withErrors('دسترسی انتخابی اشتباه است.');
                }
            }
        }

        $member->roles()->sync($request->roles);
        $member->permissions()->sync($request->permissions);

        // redirect
        return to_route($this->panel . '.members.index');
    }

    public function edit(Member $member, Request $request)
    {
        $this->authorize('member-update', $member);

        if ( $this->panel == 'admin' ) {

            $hotels = $this->getHotels();

        } elseif ( $this->panel == 'manager' ) {

            $hotels = $this->getHotels(true);
        }

        $panel = $this->panel;

        return view('panels.' . $this->panel . '.members.edit', compact('member', 'hotels', 'panel'));

    }

    public function update(Request $request, Member $member)
    {
        $this->authorize('member-update', $member);

        // validation
        $request->validate([
            'name' => ['bail', 'required', 'string', 'max:40'],
            'username' => ['bail', 'required', Rule::unique('members', 'username')->ignore($member->id),'string', 'between:5,10'],
            'mobile' => ['bail','required', Rule::unique('members', 'phone')->ignore($member->id), 'regex:/(09)[0-9]{9}/', 'numeric', 'digits:11'],
            'hotel' => ['required'],
        ]);

        if ( $this->panel == 'admin' ) {

            $hotel = Hotel::findOrFail($request->hotel);

        } elseif ( $this->panel == 'manager' ) {

            $hotel = Hotel::where('id', $request->hotel)->where('manager_id', $this->getCurrentManager()->id)->firstOrFail();
        }

        // set is_blocked value
        $is_blocked = is_null($request->status) ? 1 : 0;

        // update
        $member->update([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->mobile,
            'is_blocked' => $is_blocked,
            'manager_id' => $hotel->manager_id,
            'hotel_id' => $hotel->id,
        ]);

        // update password
        if ( ! is_null($request->password) || ! is_null($request->password_confirmation) ) {

            $request->validate([
                'password' => ['bail', 'required', Password::min(8)->letters()->numbers(), 'confirmed'],
            ]);

            $member->update([
                'password' => Hash::make($request->password),
            ]); 
        }


        // roles & permissions
        if (isset($request->roles)) {

            $request->validate([
                'roles' => ['required', 'array'],
            ]);

            foreach ($request->roles as $role) {
                $role_guard = Role::find($role)->guard;

                if ( $role_guard != 'member' ) {
                    return redirect()->back()->withErrors('نقش انتخابی اشتباه است.');
                }
            }
        }

        if (isset($request->permissions)) {

            $request->validate([
                'permissions' => ['required', 'array'],
            ]);

            foreach ($request->permissions as $permission) {
                $permission_guard = Permission::find($permission)->guard;
    
                if ( $permission_guard != 'member' ) {
                    return redirect()->back()->withErrors('دسترسی انتخابی اشتباه است.');
                }
            }
        }

        $member->roles()->sync($request->roles);
        $member->permissions()->sync($request->permissions);

        // redirect
        return to_route($this->panel . '.members.index');
    }
}