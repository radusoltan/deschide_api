<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Role::with('permissions')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "permissions" => "array"
        ]);

        $role = Role::create([
            "name" => $request->name,
            'guard_name' => 'web'
        ]);
        $role->syncPermissions($request->permissions);
        return $role->load('permissions');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return $role->load('permissions');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        request()->validate([
            'name' => ['required','string'],
            'permissions' => ['array']
        ]);

        $role->update([
            'name' => request('name')
        ]);

        $permissions = Permission::findMany(request('permissions'))->pluck('id','id');
        // dump($permissions);
        $role->syncPermissions($permissions);

        return $role->load('permissions');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        return $role->delete();
    }
}
