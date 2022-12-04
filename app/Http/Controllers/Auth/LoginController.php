<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->all();

        if(Auth::attempt($credentials)) {

            return response('register successful!', Response::HTTP_OK);
        }

        return response('registration error!', Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
