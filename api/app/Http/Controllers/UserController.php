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
        if ($this->areNotEmptyLoginParameters($request) && $this->isLoginSuccess($auth)) {
            $token = ['token' => 'token_example'];
            return response()->json($token, 200);
        } else {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
    }

    private function areNotEmptyLoginParameters(Request $request)
    {
        return $request->has('email') && $request->has('password');
    }

    private function isLoginSuccess($auth)
    {
        return $auth::attempt([
            'email' => request('email'), 
            'password' => request('password')
        ]);
    }
}
