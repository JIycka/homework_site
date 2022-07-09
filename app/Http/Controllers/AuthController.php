<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required','email'],
            'password' => ['required'],
        ]);

        $user = User::query()
            ->where('email', '=', $credentials['username'])
            ->first();

        if (null === $user) {
            $user = User::create([
                'name' => '',
                'email' => $credentials['username'],
                'password' => Hash::make($credentials['password'])
            ]);
        } else {
            if (!Hash::check($credentials['password'], $user->password)) {
                return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
            }
        }

        Auth::login($user);

        $request->session()->regenerate();

        return back();

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

    }

}
