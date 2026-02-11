<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // GET all users
    public function index()
    {
        return response()->json(User::all());
    }

    // POST create user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json($user, 201);
    }

    // GET single user
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // PUT update user
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
        ]);

        return response()->json($user);
    }

    // DELETE user
    public function destroy(string $id)
    {
        User::destroy($id);

        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }
}