<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FolderService
{
    public function createFolder(object $data)
    {
        Storage::makeDirectory(Auth::user()->name . '/' . $data['folderName']);

    }
}
