<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    
    public function index()
    {
        $permissions = Permission::paginate();

        return view('panels.admin.permissions.all', compact('permissions') );
    }


    public function create()
    {
        return view('panels.admin.permissions.add');
    }

    
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => ['bail', 'required', 'string', 'max:40'],
            'label' => ['bail', 'required', 'string', 'max:200'],
            'guard' => ['required', Rule::in(['admin', 'manager', 'member'])],
        ]);

        Permission::create($validated_data);

        return to_route('admin.permissions.index');
    }

   
    public function edit(Permission $permission)
    {
        return view('panels.admin.permissions.edit', compact('permission'));
    }


    public function update(Request $request, Permission $permission)
    {
        $validated_data = $request->validate([
            'name' => ['bail', 'required', 'string', 'max:40'],
            'label' => ['bail', 'required', 'string', 'max:200'],
            'guard' => ['required', Rule::in(['admin', 'manager', 'member'])],
        ]);

        $permission->update($validated_data);

        return to_route('admin.permissions.index');
    }
}
