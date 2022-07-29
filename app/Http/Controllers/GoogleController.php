<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;


class GoogleController
{
    public function callback(Request $request): \Illuminate\Http\RedirectResponse
    {
        $response = Http::withHeaders(['Accept' => 'application/json'])
            ->asForm()
            ->post('https://accounts.google.com/o/oauth2/token', [
                'client_id' => config('oauth.google.client_id'),
                'client_secret' => config('oauth.google.client_secret'),
                'redirect_uri' => config('oauth.google.callback_uri'),
                'grant_type' => 'authorization_code',
                'code' => $_GET['code'],
            ]);

        $token = $response['access_token'];

        $userResponse = Http::withHeaders(['Authorization' => 'Bearer ' . $token])
            ->get('https://www.googleapis.com/oauth2/v1/userinfo');

        $data = json_decode($userResponse->getBody()->getContents(), true);

        $user = User::query()
            ->where('email' , '=' , $data['email'])
            ->first();

        if ($user === null) {
            $user = User::create([
                'name' => $userResponse['name'],
                'email' => $data['email'],
                'password' => Hash::make(Str::random(8))
            ]);
        }

        Auth::login($user);

        return back();
    }
}
