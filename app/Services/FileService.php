<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class FileService
{
    /**
     * @param File $file
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function renameFile(File $file, Request $request)
    {
        Storage::move($file->path . '/' . $file->name, $file->path . '/' . $request->new_name);

        $hashName = Hash::make($request->new_name);
        $file->update([
            'name' => $request->new_name,
            'hash_name' => $hashName
        ]);

        return response(['message' => 'success'], 200);
    }

    /**
     * @param string|null $dir
     * @return string
     */
    public function configurePath(?string $dir): string
    {
        return Auth::user()->name . '/' . $dir;
    }

}
