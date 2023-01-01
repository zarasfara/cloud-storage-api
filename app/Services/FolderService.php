<?php

namespace App\Services;

use App\Models\Folder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FolderService
{
    public function createFolder(string $folderName, int $userId)
    {
        Storage::makeDirectory(Auth::user()->name . '/' . $folderName);

        Folder::create([
            'name' => $folderName,
            'user_id' => $userId
        ]);
    }

    /**
     * @param $userName
     * @return array
     */
    public function scanDisk($userName): array
    {
        return Storage::allFiles($userName);
    }
}
