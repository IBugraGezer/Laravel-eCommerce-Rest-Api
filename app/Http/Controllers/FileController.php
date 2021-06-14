<?php

namespace App\Http\Controllers;

use App\Helpers\FileManager;
use App\Http\Requests\DownloadFileFromPublicStorageRequest;
use App\Http\Requests\GetDirRequest;
use App\Http\Requests\GetDirUnderPublicStorageRequest;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function getPublicStorageDir() {
        return FileManager::getPublicStorageDir();
    }

    public function getAnyDirUnderPublicStorage(GetDirUnderPublicStorageRequest $request) {
        $data = $request->validated();
        return response(FileManager::getAnyDirUnderPublicStorage($data["path"]), 200);
    }

    public function downloadFileFromPublicStorage(DownloadFileFromPublicStorageRequest $request) {
        $data = $request->validated();
        return response()->download(FileManager::getPublicStoragePath($data['path']));
    }
}
