<?php

namespace Tests\E2E;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Docuco\Domain\Documents\Collections\DocumentCollection;

class GetAllDocumentsE2ETest extends TestCase
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
        [$user, $token] = $this->get_user_and_token_after_login();

        $response = $this->make_get_petition($token);

        $response
            ->assertStatus(200)
            ->assertExactJson(['documents' => []]);
    }

    public function test_return_documents_when_user_logged()
    {
        [$users_group, $document, $user, $token] = get_user_group_document_user_and_token_after_login($this);

        $response = $this->make_get_petition($token);

        $response
            ->assertStatus(200)
            ->assertJson(['documents' => [
                [
                    'id' => $document->id,
                    'name' => $document->name,
                    'description' => $document->description,
                    'price' => $document->price,
                    'url' => $document->url,
                    'date_of_issue' => $document->date_of_issue,
                    'users_group_id' => $document->users_group_id,
                    'updated_at' => $document->updated_at,
                    'created_at' => $document->created_at,
                ]
            ]]);
    }

    public function test_return_documents_for_users_group_when_user_logged_and_are_more_users_group_with_documents()
    {
        [$users_group_1, $document_1, $user_1, $token_1] = get_user_group_document_user_and_token_after_login($this);
        [$users_group_2, $document_2, $user_2, $token_2] = get_user_group_document_user_and_token_after_login($this);

        $response = $this->make_get_petition($token_1);

        $response
            ->assertStatus(200)
            ->assertJsonCount(1, 'documents')
            ->assertJson(['documents' => [
                ['id' => $document_1->id]
            ]]);
    }

    public function test_return_two_documents_when_user_logged_and_have_two_documents()
    {
        [$users_group, $document_1, $user, $token] = get_user_group_document_user_and_token_after_login($this);
        $document_2 = create_document($users_group->id);
        
        $response = $this->make_get_petition($token);

        $response
            ->assertStatus(200)
            ->assertJsonCount(2, 'documents')
            ->assertJson(['documents' => [
                ['id' => $document_1->id],
                ['id' => $document_2->id]
            ]]);
    }

    private function get_user_and_token_after_login()
    {
        $users_group = create_users_group();
        $password = '123456';
        $role = create_role();
        $user = create_user($users_group->id, $role->id, $password);
        $token = do_login_and_get_token($this, $user->email, $password);

        return [$user, $token];
    }

    private function make_get_petition($token = '')
    {
        $endpoint = '/api/documents';
        return $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->json('GET', $endpoint);
    }
}
