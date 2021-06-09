<?php


namespace App\Helper;


class AuthHelper
{
    public static function checkAdmin() {
        return Auth('sanctum')->check() && Auth('sanctum')->user()->tokenCan('admin');
    }

    public static function checkLogin() {
        return Auth('sanctum')->check();
    }
}