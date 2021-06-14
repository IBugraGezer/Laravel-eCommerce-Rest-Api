<?php

namespace App\Http\Controllers;

use App\Helpers\FileManager;
use App\Http\Requests\DownloadFileFromPublicStorageRequest;
use App\Http\Requests\GetDirUnderPublicStorageRequest;
use App\Http\Requests\UploadFileToPublicStorageRequest;

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

    public function uploadFileToPublicStorage(UploadFileToPublicStorageRequest $request) {
        $data = $request->validated();

        if(!$request->hasFile('file'))
            return response(config('responses.as_array.bad_request'), 400);

        return FileManager::uploadFileToPublicStoragePath($request->file('file'), $data['path']);
    }
}
