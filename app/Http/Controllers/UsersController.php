<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersController
{
    public function index()
    {
        $users = User::all();

        return view('users', ['items' => $users]);
    }
}
