<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;



class TokenService
{
    public static function getTokenUser($request)
    {
        $token = self::getTokenFromRequest($request);

        $user = User::getUser($token) ?? User::makeUser(['login_id' => $token]);

        return $user;
    }

    private static function getTokenFromRequest($request)
    {
        $token = $request->cookie('access_token');

        if (!$token) {
            $token = self::generateToken();
            Cookie::queue('access_token', $token, config('token.expires', 2880));
        }

        return $token;
    }

    private static function generateToken(): string
    {
        return Str::random(config('token.length', 32));
    }
}
