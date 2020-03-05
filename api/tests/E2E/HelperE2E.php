<?php

namespace Tests\E2E;

use Faker;
use Docuco\Domain\Documents\Entities\Document;
use Docuco\Domain\Documents\Collections\TypeCollection;
use Docuco\Domain\Users\Entities\User;
use Docuco\Domain\Users\ValueObjects\UserGroupVO;
use Docuco\Domain\Users\ValueObjects\RoleVO;

function create_role(string $name = ''): RoleVO
{
    $role_model = factory('Docuco\Models\RoleModel'::class)->create([
        'name' => $name
    ]);
    return new RoleVO($role_model->id, $role_model->name);
}

function create_user_group(): UserGroupVO
{
    $user_group_model = factory('Docuco\Models\UserGroupModel'::class)->create();
    return new UserGroupVO($user_group_model->id, $user_group_model->name);
}

function create_user(int $user_group_id, int $role_id, string $password): User
{
    $user_model = factory('Docuco\Models\UserModel'::class)->create([
        'user_group_id' => $user_group_id,
        'role_id' => $role_id,
        'password' => bcrypt($password)
    ]);

    $user_group = new UserGroupVO($user_model->user_group_id, '');
    $role = new RoleVO($user_model->role_id, '');

    return new User(
        $user_model->id,
        $user_model->name,
        $user_model->email,
        $user_group,
        $role
    );

    // public $id;
    // public $name;
    // public $email;
    // public $role;
    // public $user_group;
}

function do_login_and_get_token($that, $email, $password): string
{
    $response = $that->json('POST', '/api/login', ['email' => $email, 'password' => $password]);

    return $response->getData()->token;
}

function create_document(int $user_group_id): Document
{
    $document_model = factory('Docuco\Models\DocumentModel'::class)->create([
        'user_group_id' => $user_group_id,
    ]);

    return Document::get_from_model($document_model);
}

function get_user_group_user_and_token_after_login($that, string $role = '')
{
    $user_group = create_user_group();
    $password = '123456';
    $role = create_role($role);
    $user = create_user($user_group->id, $role->id, $password);
    $token = do_login_and_get_token($that, $user->email, $password);

    return [$user_group, $user, $token, $password];
}

function get_user_group_document_user_and_token_after_login($that, string $role = '')
{
    [$user_group, $user, $token, $password] = get_user_group_user_and_token_after_login($that, $role);
    $document = create_document($user_group->id);

    return [$user_group, $document, $user, $token, $password];
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
        'types' => $document->types->all()
    ];
}

function get_user_group_edit_user_and_token_after_login($that)
{
    return get_user_group_user_and_token_after_login($that, 'EDIT');
}

function get_user_group_admin_user_and_token_after_login($that)
{
    return get_user_group_user_and_token_after_login($that, 'ADMIN');
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
    return [
        'id', 'types', 'name', 'description', 'price', 'url', 'date_of_issue'
    ];
}
