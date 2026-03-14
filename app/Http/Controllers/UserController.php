<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return $users;
    }

    public function show($id)
    {
        $user = User::find($id);

        return $user;
    }

}