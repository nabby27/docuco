<?php

namespace Tests\E2E;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Docuco\Domain\Documents\Collections\DocumentCollection;

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
        $users_group = create_users_group();
        $password = '123456';
        $role = create_role();
        $user = create_user($users_group->id, $role->id, $password);

        $token = do_login_and_get_token($this, $user->email, $password);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->json('GET', '/api/documents');

        $response
            ->assertStatus(200)
            ->assertExactJson(['documents' => []]);
    }

    public function test_return_documents_when_user_logged()
    {
        $users_group = create_users_group();
        $password = '123456';
        $role = create_role();
        $user = create_user($users_group->id, $role->id, $password);
        $document = create_document($users_group->id);
        $document_collection = new DocumentCollection();
        $document_collection->add($document);


        $token = do_login_and_get_token($this, $user->email, $password);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->json('GET', '/api/documents');

        $response
            ->assertStatus(200)
            ->assertJson(['documents' => $document_collection->all()]);
    }
}
