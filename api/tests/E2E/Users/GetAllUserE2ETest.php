<?php

namespace Tests\E2E;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GetAllUserE2ETest extends TestCase
{
    use DatabaseTransactions;

    private $endpoint = '/api/users';

    public function test_return_error_message_when_user_not_logged()
    {
        assert_unauthenticated($this, $this->endpoint);
    }

    public function test_return_only_users_for_group_when_user_logged()
    {
        $user_group = create_user_group('first user group');
        create_user($user_group);
        create_user($user_group);
        [$user, $token, $password] = get_user_and_token_after_login($this, $user_group);

        $response = $this->make_get_petition($token);

        $response
            ->assertStatus(200)
            ->assertJsonCount(3, 'users');
    }

    // public function test_return_documents_for_user_group_when_user_logged_and_are_more_user_group_with_documents()
    // {
    //     [$user_group_1, $document_1, $user_1, $token_1] = get_user_group_document_user_and_token_after_login($this);
    //     [$user_group_2, $document_2, $user_2, $token_2] = get_user_group_document_user_and_token_after_login($this);

    //     $response = $this->make_get_petition($token_1);

    //     $response
    //         ->assertStatus(200)
    //         ->assertJsonCount(1, 'documents')
    //         ->assertJson(['documents' => [
    //             ['id' => $document_1->id]
    //         ]]);
    // }

    // public function test_return_two_documents_when_user_logged_and_have_two_documents()
    // {
    //     [$user_group, $document_1, $user, $token] = get_user_group_document_user_and_token_after_login($this);
    //     $document_2 = create_document($user_group->id);

    //     $response = $this->make_get_petition($token);

    //     $response
    //         ->assertStatus(200)
    //         ->assertJsonCount(2, 'documents')
    //         ->assertJson(['documents' => [
    //             ['id' => $document_1->id],
    //             ['id' => $document_2->id]
    //         ]]);
    // }

    private function make_get_petition($token = '')
    {
        return $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->json('GET', $this->endpoint);
    }
}
