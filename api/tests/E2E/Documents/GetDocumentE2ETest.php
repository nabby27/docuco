<?php

namespace Tests\E2E;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GetDocumentE2ETest extends TestCase
{
    use DatabaseTransactions;

    public function test_return_error_message_when_user_not_logged()
    {
        $response = $this->json('GET', '/api/documents');

        $response
            ->assertStatus(401)
            ->assertExactJson(['message' => 'Unauthenticated.']);
    }

    public function test_return_empty_array_when_user_logged_and_not_have_documents()
    {
        $password = '123456';
        $role = create_role();
        $users_group = create_users_group();
        $user = create_user($users_group->id, $role->id, $password);

        $token = do_login_and_get_token($this, $user->email, $password);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->json('GET', '/api/documents');

        $response
            ->assertStatus(200)
            ->assertExactJson(['documents' => []]);
    }
}
