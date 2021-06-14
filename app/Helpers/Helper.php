<?php


namespace App\Helpers;


class Helper
{
    public static function filterFirstPublic($path)
    {
        $path = str_starts_with($path, "public") ?
            mb_substr($path, 6, strlen($path)) :
            $path;

        return $path;
    }
}