<?php


namespace App\Helpers;


class AuthHelper
{
    public static function checkAdmin() {
        return Auth('sanctum')->check() && Auth('sanctum')->user()->tokenCan('admin');
    }

    public static function checkLogin() {
        return Auth('sanctum')->check();
    }
}