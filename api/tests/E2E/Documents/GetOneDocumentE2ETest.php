<?php

namespace Tests\E2E;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Docuco\Domain\Documents\Collections\DocumentCollection;

class GetOneDocumentE2ETest extends TestCase
{
    use DatabaseTransactions;

    public function test_return_error_message_when_user_not_logged()
    {
        $document_id = 1;
        $response = $this->json('GET', '/api/documents/' . $document_id);

        $response
            ->assertStatus(401)
            ->assertExactJson(['message' => 'Unauthenticated.']);
    }

    public function test_return_error_message_when_user_is_logged_but_document_not_exist()
    {
        $users_group = create_users_group();
        $password = '123456';
        $document_id = 1;
        $role = create_role();
        $user = create_user($users_group->id, $role->id, $password);
        $token = do_login_and_get_token($this, $user->email, $password);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->json('GET', '/api/documents/' . $document_id);

        $response
            ->assertStatus(404)
            ->assertExactJson(['message' => 'Document not exist.']);
    }

    public function test_return_documents_when_user_logged_and_have_this_document()
    {
        [$users_group, $document, $user, $token, $password] = get_user_group_document_user_and_token_after_login($this);

        $token = do_login_and_get_token($this, $user->email, $password);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->json('GET', '/api/documents/' . $document->id);

        $response
            ->assertStatus(200)
            ->assertJson(['document' => [
                'id' => $document->id]
            ]);
    }

}
