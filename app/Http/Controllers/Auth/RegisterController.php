<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use App\Models\User;
use App\Services\FolderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function register(Request $request, FolderService $service)
    {
        $userDto = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::create($userDto);

        Auth::login($user);

        Folder::create([
            'name' => $user['name'],
            'user_id' => $user['id']
        ]);

        return response('register successful!', Response::HTTP_OK );
    }
}
