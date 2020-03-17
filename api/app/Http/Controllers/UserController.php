<?php

namespace Docuco\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Docuco\Domain\Users\Actions\GetOneUserAction;
use Docuco\Domain\Users\Actions\GetAllUsersAction;
use Docuco\Infrastructure\Repositories\Users\UsersRepositoryORM;
use Docuco\Infrastructure\Services\GetUserGroupIdFromRequestService;
use Docuco\Infrastructure\Services\GetUserIdFromRequestService;

class UserController extends Controller
{
    private $user_repository;

    public function __construct()
    {
        $this->user_repository = new UsersRepositoryORM();
        $this->get_user_group_id_from_request_service = new GetUserGroupIdFromRequestService();
        $this->get_user_id_from_request_service = new GetUserIdFromRequestService();
    }

    public function login(Request $request)
    {
        $auth = new Auth();
        if (!$this->is_login_success($request, $auth)) {
            return response()->json(['message' => 'You have entered an invalid username or password.'], 401);
        }

        $token = $this->create_token($auth);
        return response()->json(['token' => $token], 200);
    }

    public function get_one_user(Request $request, int $user_id)
    {
        $user_group_id = $this->get_user_group_id_from_request_service->execute($request);
        $get_one_user_action = new GetOneUserAction($this->user_repository);
        $user = $get_one_user_action->execute($user_group_id, $user_id);

        if (!isset($user)) {
            return response()->json(['message' => 'User not exist.'], 404);
        }

        return response()->json(['user' => $user], 200);
    }

    public function get_current_user(Request $request)
    {
        $user_group_id = $this->get_user_group_id_from_request_service->execute($request);
        $user_id = $this->get_user_id_from_request_service->execute($request);

        $get_one_user_action = new GetOneUserAction($this->user_repository);
        $user = $get_one_user_action->execute($user_group_id, $user_id);

        if (!isset($user)) {
            return response()->json(['message' => 'User not exist.'], 404);
        }

        return response()->json(['user' => $user], 200);
    }

    public function get_all_users(Request $request)
    {
        $user_group_id = $this->get_user_group_id_from_request_service->execute($request);
        $get_all_users_action = new GetAllUsersAction($this->user_repository);
        $user_collection = $get_all_users_action->execute($user_group_id);

        return response()->json(['users' => $user_collection->all()], 200);
    }

    private function is_login_success($request, $auth)
    {
        if ($this->are_empty_login_parameters($request)) {
            return false;
        }

        return $auth::attempt([
        'email' => request('email'),
        'password' => request('password')
        ]);
    }

    private function are_empty_login_parameters(Request $request)
    {
        return !$request->has('email') || !$request->has('password');
    }

    private function create_token($auth)
    {
        return $auth::user()->createToken($_ENV['APP_SECRET_KEY_TOKEN'])->accessToken;
    }
}
