<?php

namespace App\Http\Controllers\Member;

use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\ResourceControllerHelpers;

class ResourceController {

    use ResourceControllerHelpers;


    public function index()
    {
        if ( $this->guard == 'admin' ) {
            $members = $this->getAllMembers();
        
        } elseif ( $this->guard == 'manager') {
            $members = $this->getCurrentManager()->members;
        }

        return view($this->guard . '.members', compact('members') );
    }

    public function create()
    {
        $managers = null;

        if ( $this->guard == 'admin' ) {
            $managers = $this->getAllManagers();
        }

        return view($this->guard . '.add-member', compact('managers') );
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'personnel_code' => ['required','unique:members,personnel_code'],
            'password' => ['required'],
            'cpassword' => ['required', 'same:password'],
        ]);

        if ( $this->guard == 'admin' ) {
            $request->validate([
                'manager' => ['required', Rule::exists('managers', 'id')],
            ]);

            $manager_id = $request->manager;

        }  elseif ( $this->guard == 'manager') {
            $manager_id = $this->getCurrentManager()->id;
        }

        Member::create([
            'name' => $request->name,
            'personnel_code' => $request->personnel_code,
            'password' => Hash::make($request->password),
            'manager_id' => $manager_id,
        ]);

        return redirect()->route( $this->guard . '.members.index');
    }


    public function edit(Member $member)
    {
        if ( $this->guard == 'manager' ) {

            if ( $member->manager_id != $this->getCurrentManager()->id ) {
                abort(404);
            }
            
        }

        return view( $this->guard . '.member', compact('member'));
    }


    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => ['required'],
            'personnel_code' => ['required', Rule::unique('members', 'personnel_code')->ignore($member->id) ],
            'status' => ['boolean'],
        ]);

        $is_blocked = $request->status == null ? 1 : 0;

        $member->update([
            'name' => $request->name,
            'personnel_code' => $request->personnel_code,
            'is_blocked' => $is_blocked,
        ]);

        
        if ( ! is_null($request->password) ) {
            $request->validate([
                'password' => ['required'],
                'cpassword' => ['required', 'same:password'],
            ]);
            $member->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route($this->guard . '.members.index');
    }


    public function destroy(Member $member)
    {
        if ($member->hotel_id != null) {
            return back()->withErrors(['deleteError' => 'this member has been assigned to ' . $member->hotel->name . ' first remove from hotel']);
        }

        $member->delete();

        return redirect()->route($this->guard . '.members.index');
    }

}