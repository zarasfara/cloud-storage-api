<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $userDto = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::create($userDto);

        Storage::disk('local')->makeDirectory($request->name);

        Auth::login($user);

        return response('register successful!', Response::HTTP_OK );
    }
}
