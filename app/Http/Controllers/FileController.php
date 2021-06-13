<?php

namespace App\Http\Controllers;

use App\Helpers\FileManager;
use App\Http\Requests\GetDirRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function getPublicStorageDir() {
        return FileManager::getPublicDir();
    }

    public function getAnyDirUnderPublicStorage(GetDirRequest $request) {
        $data = $request->validated();
        return response(FileManager::getAnyDirUnderPublicStorage($data["path"]), 200);
    }
}
