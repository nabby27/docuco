<?php

namespace Tests\E2E;

use Docuco\Models\UserModel;
use Docuco\Models\UsersGroupModel;
use Docuco\Models\RoleModel;

function do_login_and_get_token($that, $email, $password)
{
    $response = $that->json('POST', '/api/login', ['email' => $email, 'password' => $password]);

    return $response->getData()->token;
}

function create_user(int $users_group_id, int $role_id, string $password): UserModel
{
    return factory('Docuco\Models\UserModel'::class)->create([
        'users_group_id' => $users_group_id,
        'role_id' => $role_id,
        'password' => bcrypt($password)
    ]);
}

function create_users_group(): UsersGroupModel
{
    return factory('Docuco\Models\UsersGroupModel'::class)->create();
}

function create_role(): RoleModel
{
    return factory('Docuco\Models\RoleModel'::class)->create();
}
