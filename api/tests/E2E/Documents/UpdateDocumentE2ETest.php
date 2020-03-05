<?php

namespace Tests\E2E;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UpdateDocumentE2ETest extends TestCase
{
    use DatabaseTransactions;

    public function test_return_error_message_when_user_not_logged()
    {
        $token = 'token_example';
        $document_id = 1;
        $document_to_update = [];

        $response = $this->make_put_petition($token, $document_id, $document_to_update);

        $response
            ->assertStatus(401)
            ->assertExactJson(['message' => 'Unauthenticated.']);
    }

    public function test_return_error_message_when_user_not_have_role_to_update_document()
    {
        [$user_group, $document, $user, $token] = get_user_group_document_user_and_token_after_login($this);
        $document_to_update = get_random_document($document->id);

        $response = $this->make_put_petition($token, $document->id, $document_to_update);

        $response
            ->assertStatus(423)
            ->assertJson(['message' => 'Not have permissions.']);
    }

    public function test_return_error_message_when_user_update_document_that_not_have()
    {
        $user_group = create_user_group();
        $document = create_document($user_group->id);
        [$user_group, $user, $token] = get_user_group_edit_user_and_token_after_login($this);

        $response = $this->make_put_petition($token, $document->id, $document);

        $response
            ->assertStatus(404)
            ->assertExactJson(['message' => 'Document not exist.']);
    }

    public function test_return_error_message_when_user_update_document_with_diferent_id()
    {
        [$user_group, $document, $user, $token] = get_user_group_document_edit_user_and_token_after_login($this);
        $document_to_update = get_random_document($document->id);

        $response = $this->make_put_petition($token, $document->id + 1, $document_to_update);

        $response
            ->assertStatus(400)
            ->assertExactJson(['message' => 'Document id on object not match with id in url.']);
    }

    public function test_update_document_when_user_have_permissions_and_have_this_document()
    {
        [$user_group, $document, $user, $token] = get_user_group_document_edit_user_and_token_after_login($this);
        $document_to_update = get_random_document($document->id);

        $response = $this->make_put_petition($token, $document->id, $document_to_update);

        $response
            ->assertStatus(200)
            ->assertJson(['document' => $document_to_update]);
    }

    private function make_put_petition($token = '', $document_id = 1, $data_to_update = [])
    {
        $endpoint = '/api/documents/' . $document_id;
        return $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->json('PUT', $endpoint, (array) $data_to_update);
    }
}
