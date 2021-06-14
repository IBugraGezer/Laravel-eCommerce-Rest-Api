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
    public static function isConsecutive($array) {
        return ((int)max($array)-(int)min($array) == (count($array)-1));
    }
}