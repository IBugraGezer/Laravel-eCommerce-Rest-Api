<?php


namespace App\Helpers;


use App\Helpers\Helper;
use Illuminate\Support\Facades\Storage;

class FileManager
{
    public static function getPublicStorageDir() {
        return FileManager::getAnyDirUnderPublicStorage("/");
    }

    public static function getAnyDirUnderPublicStorage($dir) {
        $items = [];

        $directories = Storage::directories("public/" . $dir);
        foreach ($directories as $directory) {
            $directory = Helper::filterFirstPublic($directory);

            $items[$directory] = "directory";
        }

        $files = Storage::files("public/" . $dir);
        foreach ($files as $file) {
            $file = Helper::filterFirstPublic($file);
            $items[$file] = "file";
        }
        return $items;
    }

    public function getPublicStoragePath($path) {
        return "public/$path";
    }

    public static function getSubItemsOfPublicDir() {
        return self::getAllItems("public");
    }

    private static function getAllItems($dir) {
        $allItems = [];

        $directories = Storage::directories($dir);

        foreach($directories as $directory) {
            $subItems = FileManager::getAllItems($directory);
            $directoryAsParsed = explode("/", $directory);
            $allItems[end($directoryAsParsed)] = $subItems;
        }

        $files = Storage::files($dir);
        foreach($files as $file) {
            $fileAsParsed = explode("/", $file);
            array_push($allItems, end($fileAsParsed));
        }

        return $allItems;
    }
}