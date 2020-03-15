<?php

namespace Tests\E2E;

use Faker;
use Docuco\Domain\Documents\Entities\Document;
// use Docuco\Domain\Documents\Collections\TagCollection;
use Docuco\Domain\Documents\Entities\Tag;
use Docuco\Domain\Users\Constants\RoleConstants;
use Docuco\Domain\Users\Entities\User;
use Docuco\Domain\Users\Entities\UserGroup;
use Docuco\Domain\Users\ValueObjects\RoleVO;
use Docuco\Models\RoleModel;
use Docuco\Models\TypeModel;

function create_role(string $name = ''): RoleModel
{
    $faker = Faker\Factory::create();

    return factory('Docuco\Models\RoleModel'::class)->create([
    'id' => RoleModel::all()->count() + 1,
    'name' => $name
    ]);
}

function create_user_group(string $name = ''): UserGroup
{
    $user_group_model = factory('Docuco\Models\UserGroupModel'::class)->create([
    'name' => $name
    ]);
    return new UserGroup($user_group_model->id, $user_group_model->name);
}

function create_user(UserGroup $user_group, string $role_name = RoleConstants::VIEW, string $password = '123456'): User
{
    $role = create_role($role_name);
    $user_model = factory('Docuco\Models\UserModel'::class)->create([
    'user_group_id' => $user_group->id,
    'role_id' => $role->id,
    'password' => bcrypt($password)
    ]);

    $user_group = new UserGroup($user_group->id, $user_group->name);
    $role = new RoleVO($role_name);

    return new User(
        $user_model->id,
        $user_model->name,
        $user_model->email,
        $user_group->name,
        $role->name
    );
}

function do_login_and_get_token($that, $email, $password): string
{
    $response = $that->json('POST', '/api/login', ['email' => $email, 'password' => $password]);

    return $response->getData()->token;
}

function create_document(int $user_group_id, int $type_id = 1): Document
{
    $document_model = factory('Docuco\Models\DocumentModel'::class)->create([
    'user_group_id' => $user_group_id,
    'type_id' => $type_id,
    ]);

    return Document::get_from_model($document_model);
}

function create_type(string $type_name = 'EXPENSE'): TypeModel
{
    return factory('Docuco\Models\TypeModel'::class)->create([
    'name' => $type_name,
    ]);
}

function get_user_group_user_and_token_after_login($that, string $role_name = '')
{
    $user_group = create_user_group('example_group');
    [$user, $token, $password] = get_user_and_token_after_login($that, $user_group, $role_name);

    return [$user_group, $user, $token, $password, $role_name];
}

function get_user_and_token_after_login($that, UserGroup $user_group, string $role_name = '')
{
    $password = '123456';
    $role = create_role($role_name);
    $user = create_user($user_group, $role->name, $password);
    $token = do_login_and_get_token($that, $user->email, $password);

    return [$user, $token, $password];
}

function get_user_group_document_user_and_token_after_login($that, string $role = '')
{
    [$user_group, $user, $token, $password, $role] = get_user_group_user_and_token_after_login($that, $role);
    $type = create_type();
    $document = create_document($user_group->id, $type->id);
    $tags = [];
    $tag = create_tag('water');
    array_push($tags, $tag);
    realtion_document_tag($document, $tag);

    return [$user_group, $document, $user, $token, $password, $tags, $role];
}

function create_tag(string $name = 'example_tag'): Tag
{
    $tag_model = factory('Docuco\Models\TagModel'::class)->create([
    'name' => $name,
    ]);

    return Tag::get_from_model($tag_model);
}

function realtion_document_tag(Document $document, Tag $tag)
{
    factory('Docuco\Models\DocumentTagModel'::class)->create([
    'document_id' => $document->id,
    'tag_id' => $tag->id,
    ]);
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
    'tags' => $document->tags
    ];
}

function get_user_structure_to_assert($user)
{
    return [
    'id' => $user->id,
    'name' => $user->name,
    'email' => $user->email,
    'user_group' => $user->user_group,
    'role' => $user->role
    ];
}

function get_user_group_edit_user_and_token_after_login($that)
{
    return get_user_group_user_and_token_after_login($that, RoleConstants::EDIT);
}

function get_user_group_admin_user_and_token_after_login($that)
{
    return get_user_group_user_and_token_after_login($that, RoleConstants::ADMIN);
}

function get_user_group_document_edit_user_and_token_after_login($that)
{
    return get_user_group_document_user_and_token_after_login($that, RoleConstants::EDIT);
}

function get_user_group_document_admin_user_and_token_after_login($that)
{
    return get_user_group_document_user_and_token_after_login($that, RoleConstants::ADMIN);
}

function get_random_document(?int $document_id = null)
{
    $faker = Faker\Factory::create();

    $document = [
    'name' => $faker->word,
    'description' => $faker->text(200),
    'price' => $faker->randomFloat,
    'url' => $faker->imageUrl,
    'date_of_issue' => $faker->date(),
    'type' => 'EXPENSE'
    ];

    if ($document_id) {
        $document['id'] = $document_id;
    }

    return $document;
}

function get_fields_document()
{
    return [
    'id', 'tags', 'name', 'description', 'price', 'url', 'date_of_issue'
    ];
}

function get_fields_user()
{
    return [
    'id', 'email', 'name', 'user_group', 'role'
    ];
}

function assert_unauthenticated($that, string $url = '')
{
    $token = '';
    $response = $that->withHeaders(['Authorization' => 'Bearer ' . $token])
    ->json('GET', $url);

    $response
    ->assertStatus(401)
    ->assertExactJson(['message' => 'Unauthenticated.']);
}
