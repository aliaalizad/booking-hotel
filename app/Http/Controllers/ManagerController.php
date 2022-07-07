<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\ResourceControllerHelpers;
use App\Models\Manager;
use App\Models\Permission;
use App\Models\Role;

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
        // validation
        $request->validate([
            'name' => ['required'],
            'username' => ['required','unique:managers,username'],
            'phone' => ['required','unique:managers,phone'],
            'email' => ['required','unique:managers,email'],
            'password' => ['required', 'confirmed'],
            'bank_account' => ['required', 'unique:managers,bank_account'],
            'commission' => ['required'],
            'city' => ['required', 'exists:cities,id'],
        ]);


        // set is_blocked value
        $is_blocked = is_null($request->status) ? 1 : 0;


        // create
        $manager = Manager::create([
            'name' => $request->name,
            'username' => $request->username,
            'is_blocked' => $is_blocked,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'email' => $request->email,
            'bank_account' => $request->bank_account,
            'commission' => $request->commission,
            'city_id' => $request->city,
        ]);


        // roles & permissions
        if (isset($request->roles)) {

            $request->validate([
                'roles' => ['required', 'array'],
            ]);

            foreach ($request->roles as $role) {
                $role_guard = Role::find($role)->guard;

                if ( $role_guard != 'manager' ) {
                    return redirect()->back()->withErrors('invalid role !');
                }
            }
        }

        if (isset($request->permissions)) {

            $request->validate([
                'permissions' => ['required', 'array'],
            ]);

            foreach ($request->permissions as $permission) {
                $permission_guard = Permission::find($permission)->guard;
    
                if ( $permission_guard != 'manager' ) {
                    return redirect()->back()->withErrors('invalid permissions !');
                }
            }
        }

        $manager->roles()->sync($request->roles);
        $manager->permissions()->sync($request->permissions);


        // redirect
        return to_route($this->panel . '.managers.index');
    }


    public function edit(Manager $manager)
    {
        return view('panels.' . $this->panel . '.managers.edit', compact('manager'));
    }


    public function update(Request $request, Manager $manager)
    {
        // validation
        $request->validate([
            'name' => ['required'],
            'username' => ['required', Rule::unique('managers', 'username')->ignore($manager->id)],
            'phone' => ['required', Rule::unique('managers', 'phone')->ignore($manager->id)],
            'email' => ['required', Rule::unique('managers', 'email')->ignore($manager->id)],
            'bank_account' => ['required', Rule::unique('managers', 'bank_account')->ignore($manager->id)],
            'commission' => ['required'],
        ]);


        // set is_blocked value
        $is_blocked = is_null($request->status) ? 1 : 0;


        // update data
        $manager->update([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'is_blocked' => $is_blocked,
            'bank_account' => $request->bank_account,
            'commission' => $request->commission,
        ]);

        // password
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


        // roles & permissions
        if (isset($request->roles)) {

            $request->validate([
                'roles' => ['array'],
            ]);

            foreach ($request->roles as $role) {
                $role_guard = Role::find($role)->guard;

                if ( $role_guard != 'manager' ) {
                    return redirect()->back()->withErrors('invalid role !');
                }
            }
        }

        if (isset($request->permissions)) {

            $request->validate([
                'permissions' => ['array'],
            ]);

            foreach ($request->permissions as $permission) {
                $permission_guard = Permission::find($permission)->guard;
    
                if ( $permission_guard != 'manager' ) {
                    return redirect()->back()->withErrors('invalid permissions !');
                }
            }
        }

        $manager->roles()->sync($request->roles);
        $manager->permissions()->sync($request->permissions);


        // redirect
        return to_route($this->panel . '.managers.index');
    }



}