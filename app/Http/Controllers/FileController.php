<?php

namespace App\Http\Controllers;

use App\Helpers\FileManager;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function getPublicDir() {
        return FileManager::getPublicDir();
    }

    public function getDir(GetDirRequest $request) {
        $data = $request->validated();

        return response(FileManager::getAnyDir($data->path), 200);
    }
}
