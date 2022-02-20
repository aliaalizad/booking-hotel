<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\ResourceControllerHelpers;
use App\Models\Hotel;
use App\Models\Manager;
use App\Models\Member;

class ManagerController extends Controller {

    use ResourceControllerHelpers;


    public function index()
    {
        $managers = $this->getManagers();
        
        return view('panels.' . $this->panel . '.managers.all', compact('managers') );
    }

    public function create()
    {
        return view('panels.' . $this->panel . '.managers.add');
    }


    public function store(Request $request)
    {
        // dd($request->input());
        $request->validate([
            'name' => ['required'],
            'username' => ['required','unique:managers,username'],
            'status' => ['boolean'],
            'phone' => ['required','unique:managers,phone'],
            'email' => ['required','unique:managers,email'],
            'province' => ['required'],
            'password' => ['required', 'confirmed'],
            'contract' => ['required', Rule::exists('contracts', 'id')],
        ]);

        // set is_blocked value
        $is_blocked = is_null($request->status) ? 1 : 0;

        Manager::create([
            'name' => $request->name,
            'username' => $request->username,
            'is_blocked' => $is_blocked,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'email' => $request->email,
            'province' => $request->province,
            'contract_id' => $request->contract,
        ]);

        return to_route( $this->panel . '.managers.index');
    }


    public function edit(Manager $manager)
    {
        return view('panels.' . $this->panel . '.managers.edit', compact('manager'));
    }


    public function update(Request $request, Manager $manager)
    {
        $request->validate([
            'name' => ['required'],
            'username' => ['required', Rule::unique('managers', 'username')->ignore($manager->id)],
            'phone' => ['required', Rule::unique('managers', 'phone')->ignore($manager->id)],
            'email' => ['required', Rule::unique('managers', 'email')->ignore($manager->id)],
            'contract' => ['required', Rule::exists('contracts', 'id')],
            'province' => ['required'],
            'status' => ['boolean'],
        ]);

        // set is_blocked value
        $is_blocked = is_null($request->status) ? 1 : 0;

        // update data
        $manager->update([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'contract_id' => $request->contract,
            'province' => $request->province,
            'is_blocked' => $is_blocked,
        ]);

        // update password
        if ( ! is_null($request->current_password) || ! is_null($request->password) || ! is_null($request->password_confirmation) ) {
            
            $request->validate([
                'current_password' => ['required'],
                'password' => ['required'],
                'password_confirmation' => ['required'],
            ]);

            if ( Hash::check($request->current_password, $manager->password) ) {
                $request->validate([
                    'password' => ['confirmed'],
                ]);
                $manager->update([
                    'password' => Hash::make($request->password),
                ]); 

            } else {
                return back()->withInput()->withErrors([
                    'invalidCurrentPasword' => 'current password is invalid'
                ]);
            }
        }

        return to_route($this->panel . '.managers.index');
    }

    public function destroy(Manager $manager) {

        Member::where('manager_id', $manager->id)->delete();
        Hotel::where('manager_id', $manager->id)->delete();

        $manager->delete();

        return to_route( $this->panel . '.managers.index');
    }

}