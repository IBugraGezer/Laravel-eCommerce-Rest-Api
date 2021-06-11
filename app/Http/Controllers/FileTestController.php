<?php

namespace App\Http\Controllers;

use App\Helpers\FileManager;
use Illuminate\Http\Request;

class FileTestController extends Controller
{
    public function test() {
        return FileManager::getPublicDir();
    }
}
