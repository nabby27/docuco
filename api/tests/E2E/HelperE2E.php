<?php

namespace Tests\E2E;

use Docuco\Models\UserModel;
use Docuco\Models\UsersGroupModel;
use Docuco\Models\RoleModel;
use Docuco\Models\DocumentModel;
use Docuco\Domain\Users\Entities\UsersGroup;
use Docuco\Domain\Users\Entities\Role;
use Docuco\Domain\Users\Entities\User;
use Docuco\Domain\Documents\Entities\Document;

function create_role(): Role
{
    $role_model = factory('Docuco\Models\RoleModel'::class)->create();
    return new Role($role_model->toArray());
}

function create_users_group(): UsersGroup
{
    $users_group_model = factory('Docuco\Models\UsersGroupModel'::class)->create();
    return new UsersGroup($users_group_model->toArray());
}

function create_user(int $users_group_id, int $role_id, string $password): User
{
    $user_model = factory('Docuco\Models\UserModel'::class)->create([
        'users_group_id' => $users_group_id,
        'role_id' => $role_id,
        'password' => bcrypt($password)
    ]);

    return new User($user_model->toArray());
}

function do_login_and_get_token($that, $email, $password): string
{
    $response = $that->json('POST', '/api/login', ['email' => $email, 'password' => $password]);

    return $response->getData()->token;
}

function create_document(int $users_group_id): Document
{
    $document_model = factory('Docuco\Models\DocumentModel'::class)->create([
        'users_group_id' => $users_group_id,
    ]);

    return new Document($document_model->toArray());
}

function get_user_group_document_user_and_token_after_login($that)
{
    $users_group = create_users_group();
    $password = '123456';
    $role = create_role();
    $user = create_user($users_group->id, $role->id, $password);
    $document = create_document($users_group->id);
    $token = do_login_and_get_token($that, $user->email, $password);

    return [$users_group, $document, $user, $token, $password];
}
