<?php

namespace Tests\E2E;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GetOneUserE2ETest extends TestCase
{
    use DatabaseTransactions;

    public function test_return_error_message_when_user_not_logged()
    {
        $token = 'token_example';
        $user_id = 1;

        $response = $this->make_get_petition($token, $user_id);

        $response
        ->assertStatus(401)
        ->assertExactJson(['message' => 'Unauthenticated.']);
    }

    public function test_return_error_message_when_user_is_logged_but_user_search_not_in_his_group()
    {
        $user_group_1 = create_user_group();
        $user_1 = create_user($user_group_1);
        [$user_group_2, $user_2, $token] = get_user_group_user_and_token_after_login($this);

        $response = $this->make_get_petition($token, $user_1->id);

        $response
        ->assertStatus(404)
        ->assertExactJson(['message' => 'User not exist.']);
    }

    public function test_return_user_when_user_logged_and_user_search_is_in_same_group()
    {
        [$user_group, $document, $user_1, $token, $password, $tags] = get_user_group_document_user_and_token_after_login($this);
        $user_2 = create_user($user_group);

        $response = $this->make_get_petition($token, $user_2->id);

        $response
        ->assertStatus(200)
        ->assertJson(['user' => get_user_structure_to_assert($user_2)])
        ->assertJsonStructure(['user' => get_fields_user()]);
    }

    private function make_get_petition($token = '', $user_id = 1)
    {
        $endpoint = '/api/users/' . $user_id;
        return $this->withHeaders(['Authorization' => 'Bearer ' . $token])
        ->json('GET', $endpoint);
    }
}
