<?php

namespace Docuco\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $auth = new Auth();
        if ($this->isLoginSuccess($request, $auth)) {
            $token = $this->createToken($auth);
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['message' => 'You have entered an invalid username or password.'], 401);
        }
    }

    private function isLoginSuccess($request, $auth)
    {
        if ($this->areNotEmptyLoginParameters($request)) {
            return $auth::attempt([
                'email' => request('email'),
                'password' => request('password')
            ]);
        }

        return false;
    }

    private function areNotEmptyLoginParameters(Request $request)
    {
        return $request->has('email') && $request->has('password');
    }

    private function createToken($auth)
    {
        return $auth::user()->createToken($_ENV['APP_SECRET_KEY_TOKEN'])->accessToken;
    }
}
