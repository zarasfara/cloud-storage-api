<?php

namespace App\Services;

use App\Models\Folder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FolderService
{
    public function createFolder(?string $folderName)
    {
        Storage::makeDirectory(Auth::user()->name . '/' . $folderName);

        Folder::create([
            'name' => $folderName,
            'user_id' => Auth::user()->id
        ]);
    }

    /**
     * @return int
     */
    public function getDiskSize(): int
    {
        return auth()->user()->files()->sum('size');

    }
}
