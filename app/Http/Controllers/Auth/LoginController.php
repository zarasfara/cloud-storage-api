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

        if(Auth::attempt($request->all())) {

            return response('login in!', Response::HTTP_OK);
        }

        return response('registration error!', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();

        return \response('logout success', 200);
    }
}
