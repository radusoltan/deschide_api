<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::with(['roles', 'roles.permissions'])->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string",
            "email" => "required|string|email",
            "password" => "required|string",
            "selectedRoles" => "array"
        ]);

        $user = User::create([
            "name" => $data['name'],
            "email" => $data['email'],
            "email_verified_at" => now(),
            "remember_token" => Str::random(10),
            "password" => Hash::make($data['password'])
        ]);

        if ($request->has('selectedRoles')){
            $user->assignRole($data['selectedRoles']);
        }

        return $user->load('roles','roles.permissions');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $user->load('roles', 'roles.permissions');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email')
        ]);

        if ($request->has('selectedRoles')){
            $user->assignRole($request->get('selectedRoles'));
        }

        return $user->load('roles', 'roles.permissions');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return $user->delete();
    }
}
