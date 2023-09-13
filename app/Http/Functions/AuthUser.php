<?php

namespace App\Http\Functions;

use Auth;
use JWTAuth;

/**
 * Class AuthUser.
 */
class AuthUser
{

    public static function user()
    {
        $user = JWTAuth::parseToken()->authenticate();
        return $user;
    }

    public static function isLoginPage()
    {
        return (request()->route()->getName() == 'admin.login');
    }

    public static function isLogoutPage()
    {
        return (request()->route()->getName() == 'admin.logout');
    }
}