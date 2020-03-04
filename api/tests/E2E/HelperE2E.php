<?php

namespace Tests\E2E;

use Faker;
use Docuco\Models\UserModel;
use Docuco\Models\UsersGroupModel;
use Docuco\Models\RoleModel;
use Docuco\Models\DocumentModel;
use Docuco\Domain\Users\Entities\UsersGroup;
use Docuco\Domain\Users\Entities\Role;
use Docuco\Domain\Users\Entities\User;
use Docuco\Domain\Documents\Entities\DocumentBase;

function create_role(string $name = ''): Role
{
    $role_model = factory('Docuco\Models\RoleModel'::class)->create([
        'name' => $name
    ]);
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

function create_document(int $users_group_id): DocumentBase
{
    $document_model = factory('Docuco\Models\DocumentModel'::class)->create([
        'users_group_id' => $users_group_id,
    ]);

    return new DocumentBase($document_model->toArray());
}

function get_user_and_token_after_login($that, string $role = '')
{
    $users_group = create_users_group();
    $password = '123456';
    $role = create_role($role);
    $user = create_user($users_group->id, $role->id, $password);
    $token = do_login_and_get_token($that, $user->email, $password);

    return [$user, $token];
}

function get_user_group_document_user_and_token_after_login($that, string $role = '')
{
    $users_group = create_users_group();
    $password = '123456';
    $role = create_role($role);
    $user = create_user($users_group->id, $role->id, $password);
    $document = create_document($users_group->id);
    $token = do_login_and_get_token($that, $user->email, $password);

    return [$users_group, $document, $user, $token, $password];
}

function get_document_structure_to_assert($document)
{
    return [
        'id' => $document->id,
        'name' => $document->name,
        'description' => $document->description,
        'price' => $document->price,
        'url' => $document->url,
        'date_of_issue' => $document->date_of_issue,
        'users_group_id' => $document->users_group_id,
        'updated_at' => $document->updated_at,
        'created_at' => $document->created_at,
    ];
}

function get_edit_user_and_token_after_login($that)
{
    return get_user_and_token_after_login($that, 'EDIT');
}

function get_admin_user_and_token_after_login($that)
{
    return get_user_and_token_after_login($that, 'ADMIN');
}

function get_user_group_document_edit_user_and_token_after_login($that)
{
    return get_user_group_document_user_and_token_after_login($that, 'EDIT');
}

function get_user_group_document_admin_user_and_token_after_login($that)
{
    return get_user_group_document_user_and_token_after_login($that, 'ADMIN');
}

function get_random_document(?int $document_id = null)
{
        $faker = Faker\Factory::create();

        $document = [
            'name' => $faker->word,
            'description' => $faker->text(200),
            'price' => $faker->randomFloat,
            'url' => $faker->imageUrl,
            'date_of_issue' => $faker->date()
        ];

        if ($document_id) {
            $document['id'] = $document_id;
        }

        return $document;
}

function getFieldsDocument()
{
    return ['id', 'name', 'description', 'price', 'url', 'date_of_issue', 'users_group_id',
    'updated_at', 'created_at'];
}
