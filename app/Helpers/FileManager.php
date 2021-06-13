<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Storage;

class FileManager
{
    public static function getPublicStorageDir() {
        return FileManager::getAnyDirUnderPublicStorage("public");
    }

    public static function getAnyDirUnderPublicStorage($dir) {
        $items = [];

        $directories = Storage::directories("public" . DIRECTORY_SEPARATOR . $dir);
        foreach ($directories as $directory) {
            $items[$directory] = "directory";
        }

        $files = Storage::files($dir);
        foreach ($files as $file) {
            $items[$file] = "file";
        }

        return $items;
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