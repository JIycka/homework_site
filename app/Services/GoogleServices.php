<?php

namespace App\Services;

class GoogleServices
{
    public static function link(): string
    {
        $parameters = [
            'client_id' => config('oauth.google.client_id'),
            'redirect_uri' => config('oauth.google.callback_uri'),
            'response_type' => 'code',
            'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
        ];
            return 'https://accounts.google.com/o/oauth2/auth?' . http_build_query($parameters);
    }
}
