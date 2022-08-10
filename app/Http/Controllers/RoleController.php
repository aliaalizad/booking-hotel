<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate();

        return view('panels.admin.roles.all', compact('roles') );
    }

    public function create()
    {
        return view('panels.admin.roles.add');
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => ['bail', 'required', 'string', 'max:40'],
            'label' => ['bail', 'required', 'string', 'max:200'],
            'guard' => ['required', Rule::in(['admin', 'manager', 'member'])],
            'permissions' => ['required', 'array'],
        ]);

        // $permissions = Permission::whereGuard($request->guard)->get()->groupBy('id')->keys()->toArray();

        foreach ($request->permissions as $permission) {
            $permission_guard = Permission::find($permission)->guard;

            if ( $permission_guard != $request->guard ) {
                return redirect()->back()->withErrors('برخی از دسترسی های انتخابی اشتباه است.');
            }
        }

        $role = Role::create($validated_data);

        $role->permissions()->sync($request->permissions);

        return to_route('admin.roles.index');
    }

    public function edit(Role $role)
    {
        return view('panels.admin.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $validated_data = $request->validate([
            'name' => ['bail', 'required', 'string', 'max:40'],
            'label' => ['bail', 'required', 'string', 'max:200'],
            'guard' => ['required', Rule::in(['admin', 'manager', 'member'])],
            'permissions' => ['required', 'array'],
        ]);

        foreach ($request->permissions as $permission) {
            $permission_guard = Permission::find($permission)->guard;

            if ( $permission_guard != $request->guard ) {
                return redirect()->back()->withErrors('برخی از دسترسی های انتخابی اشتباه است.');
            }
        }

        $role->update($validated_data);

        $role->permissions()->sync($request->permissions);

        return to_route('admin.roles.index');
    }
}
