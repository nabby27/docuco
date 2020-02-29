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
        if ($this->is_login_success($request, $auth)) {
            $token = $this->create_token($auth);
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['message' => 'You have entered an invalid username or password.'], 401);
        }
    }

    private function is_login_success($request, $auth)
    {
        if ($this->are_not_empty_login_parameters($request)) {
            return $auth::attempt([
                'email' => request('email'),
                'password' => request('password')
            ]);
        }

        return false;
    }

    private function are_not_empty_login_parameters(Request $request)
    {
        return $request->has('email') && $request->has('password');
    }

    private function create_token($auth)
    {
        return $auth::user()->createToken($_ENV['APP_SECRET_KEY_TOKEN'])->accessToken;
    }
}
