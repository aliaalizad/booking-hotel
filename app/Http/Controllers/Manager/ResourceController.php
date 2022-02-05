<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\ResourceControllerHelpers;
use App\Models\Hotel;
use App\Models\Manager;
use App\Models\Member;

class ResourceController {

    use ResourceControllerHelpers;


    public function index()
    {
        $managers = $this->getAllManagers();
        return view($this->guard . '.managers', compact('managers') );
    }

    public function create()
    {
        $contracts = $this->getAllContracts();

        return view($this->guard . '.add-manager', compact('contracts') );
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'username' => ['required','unique:managers,username'],
            'phone' => ['required','unique:managers,phone'],
            'email' => ['required','unique:managers,email'],
            'province' => ['required'],
            'password' => ['required'],
            'cpassword' => ['required', 'same:password'],
            'contract' => ['required', Rule::exists('contracts', 'id')],
        ]);

        Manager::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'email' => $request->email,
            'province' => $request->province,
            'contract_id' => $request->contract,
        ]);

        return redirect()->route( $this->guard . '.managers.index');
    }


    public function edit(Manager $manager)
    {
        $contracts = $this->getAllContracts();

        return view( $this->guard . '.manager', compact('manager', 'contracts'));
    }


    public function update(Request $request, Manager $manager)
    {
        $request->validate([
            'name' => ['required'],
            'username' => ['required', Rule::unique('managers', 'username')->ignore($manager->id)],
            'status' => ['boolean'],
        ]);

        $is_blocked = $request->status == null ? 1 : 0;

        $manager->update([
            'name' => $request->name,
            'username' => $request->username,
            'is_blocked' => $is_blocked,
        ]);

        if ( ! is_null($request->password) ) {
            $request->validate([
                'password' => ['required'],
                'cpassword' => ['required', 'same:password'],
            ]);
            $manager->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route($this->guard . '.managers.index');
    }

    public function destroy(Manager $manager) {

        Member::where('manager_id', $manager->id)->delete();
        Hotel::where('manager_id', $manager->id)->delete();

        $manager->delete();

        return redirect()->route( $this->guard . '.managers.index');
    }

}