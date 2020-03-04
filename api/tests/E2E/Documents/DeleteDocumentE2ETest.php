<?php

namespace Tests\E2E;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeleteDocumentE2ETest extends TestCase
{
    use DatabaseTransactions;

    public function test_return_error_message_when_user_not_logged()
    {
        $token = 'token_example';
        $document_id = 1;

        $response = $this->make_delete_petition($token, $document_id);

        $response
            ->assertStatus(401)
            ->assertExactJson(['message' => 'Unauthenticated.']);
    }

    public function test_return_error_message_when_user_not_have_role_to_delete_document()
    {
        [$users_group, $document, $user, $token] = get_user_group_document_edit_user_and_token_after_login($this);

        $response = $this->make_delete_petition($token, $document->id);
        
        $response
            ->assertStatus(423)
            ->assertJson(['message' => 'Not have permissions.']);
    }

    public function test_return_error_message_when_user_delete_document_that_not_have()
    {
        $users_group = create_users_group();
        $document = create_document($users_group->id);
        [$user, $token] = get_admin_user_and_token_after_login($this);

        $response = $this->make_delete_petition($token, $document->id);
        
        $response
            ->assertStatus(404)
            ->assertExactJson(['message' => 'Document not exist.']);
    }

    public function test_delete_document_when_user_have_permissions_and_have_this_document()
    {
        [$users_group, $document, $user, $token] = get_user_group_document_admin_user_and_token_after_login($this);

        $response = $this->make_delete_petition($token, $document->id);
        
        $response
            ->assertStatus(200)
            ->assertJson(['message' => 'Document deleted successfully.']);
    }

    private function make_delete_petition($token = '', $document_id = 1)
    {
        $endpoint = '/api/documents/' . $document_id;
        return $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->json('DELETE', $endpoint);
    }
}
