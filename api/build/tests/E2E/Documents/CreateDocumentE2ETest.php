<?php

namespace Tests\E2E;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateDocumentE2ETest extends TestCase
{
    use DatabaseTransactions;

    public function test_return_error_message_when_user_not_logged()
    {
        $token = 'token_example';
        $document = [];

        $response = $this->make_post_petition($token, $document);

        $response
        ->assertStatus(401)
        ->assertExactJson(['message' => 'Unauthenticated.']);
    }

    public function test_return_error_message_when_user_not_have_permissions_to_create_document()
    {
        $document = [];
        [$user_group, $user, $token] = get_user_group_user_and_token_after_login($this);

        $response = $this->make_post_petition($token, $document);

        $response
        ->assertStatus(423)
        ->assertJson(['message' => 'Not have permissions.']);
    }

  // public function test_create_document_when_user_have_permissions()
  // {
  //   $document = get_random_document();

  //   [$user_group, $user, $token] = get_user_group_edit_user_and_token_after_login($this);

  //   $response = $this->make_post_petition($token, $document);

  //   $response
  //     ->assertStatus(200)
  //     ->assertJson(['document' => $document])
  //     ->assertJsonStructure(['document' => get_fields_document()]);
  // }

    private function make_post_petition($token = '', $document = [])
    {
        $endpoint = '/api/documents/';
        return $this->withHeaders(['Authorization' => 'Bearer ' . $token])
        ->json('POST', $endpoint, $document);
    }
}
