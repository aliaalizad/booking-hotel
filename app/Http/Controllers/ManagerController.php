<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\ResourceControllerHelpers;
use App\Models\Manager;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Validation\Rules\Password;

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
            'name' => ['bail', 'required', 'string', 'max:40'],
            'username' => ['bail', 'required','unique:managers,username', 'string', 'between:5,20'],
            'mobile' => ['bail', 'required','unique:managers,phone', 'regex:/(09)[0-9]{9}/', 'digits:11', 'numeric'],
            'email' => ['bail', 'required','unique:managers,email', 'email'],
            'city' => ['required', 'exists:cities,id'],
            'password' => ['bail', 'required', Password::min(8)->letters()->numbers(), 'confirmed'],
            'bank_account' => ['bail', 'required', 'numeric', 'digits:24', 'unique:managers,bank_account'],
            'commission' => ['bail', 'required', 'numeric', 'between:0, 100'],
        ]);


        // set is_blocked value
        $is_blocked = is_null($request->status) ? 1 : 0;


        // create
        $manager = Manager::create([
            'name' => $request->name,
            'username' => $request->username,
            'is_blocked' => $is_blocked,
            'password' => Hash::make($request->password),
            'phone' => $request->mobile,
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
                    return redirect()->back()->withErrors('نفش انتخابی اشتباه است.');
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
                    return redirect()->back()->withErrors('دسترسی انتخابی اشتباه است.');
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
            'name' => ['bail', 'required', 'string', 'max:40'],
            'username' => ['bail', 'required', Rule::unique('managers', 'username')->ignore($manager->id), 'string', 'between:5,20'],
            'mobile' => ['bail', 'required', Rule::unique('managers', 'phone')->ignore($manager->id), 'regex:/(09)[0-9]{9}/', 'digits:11', 'numeric'],
            'email' => ['bail', 'required', Rule::unique('managers', 'email')->ignore($manager->id)], 'email', 'bail',
            'bank_account' => ['bail', 'required', Rule::unique('managers', 'bank_account')->ignore($manager->id), 'numeric', 'digits:24', 'unique:managers,bank_account'],
            'commission' => ['bail', 'required', 'numeric', 'between:0, 100'],
        ]);

        // set is_blocked value
        $is_blocked = is_null($request->status) ? 1 : 0;

        // update data
        $manager->update([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->mobile,
            'email' => $request->email,
            'is_blocked' => $is_blocked,
            'bank_account' => $request->bank_account,
            'commission' => $request->commission,
        ]);

        // password
        if ( ! is_null($request->password) || ! is_null($request->password_confirmation) ) {

            $request->validate([
                'password' => [ 'bail','required', Password::min(8)->letters()->numbers(), 'confirmed'],
            ]);

            $manager->update([
                'password' => Hash::make($request->password),
            ]);
        }


        // roles & permissions
        if (isset($request->roles)) {

            $request->validate([
                'roles' => ['array'],
            ]);

            foreach ($request->roles as $role) {
                $role_guard = Role::find($role)->guard;

                if ( $role_guard != 'manager' ) {
                    return redirect()->back()->withErrors('نقش انتخابی اشتباه است.');
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
                    return redirect()->back()->withErrors('دسترسی انتخابی اشتباه است.');
                }
            }
        }

        $manager->roles()->sync($request->roles);
        $manager->permissions()->sync($request->permissions);


        // redirect
        return to_route($this->panel . '.managers.index');
    }
}