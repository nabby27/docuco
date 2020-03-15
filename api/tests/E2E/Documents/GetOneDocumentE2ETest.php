<?php

namespace Tests\E2E;

use Docuco\Domain\Users\Constants\RoleConstants;
use Docuco\Models\TagModel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GetOneDocumentE2ETest extends TestCase
{
  use DatabaseTransactions;

  public function test_return_error_message_when_user_not_logged()
  {
    $token = 'token_example';
    $document_id = 1;

    $response = $this->make_get_petition($token, $document_id);

    $response
      ->assertStatus(401)
      ->assertExactJson(['message' => 'Unauthenticated.']);
  }

  public function test_return_error_message_when_user_is_logged_but_document_not_exist()
  {
    $user_group = create_user_group();
    $password = '123456';
    $document_id = 1;
    $role_name = RoleConstants::ADMIN;
    $user = create_user($user_group, $role_name, $password);
    $token = do_login_and_get_token($this, $user->email, $password);

    $response = $this->make_get_petition($token, $document_id);

    $response
      ->assertStatus(404)
      ->assertExactJson(['message' => 'Document not exist.']);
  }

  public function test_return_error_message_when_user_not_have_this_document()
  {
    $user_group_1 = create_user_group();
    $document = create_document($user_group_1->id);

    $password = '123456';
    $user_group_2 = create_user_group();
    $role_name = RoleConstants::EDIT;
    $user = create_user($user_group_2, $role_name, $password);
    $token = do_login_and_get_token($this, $user->email, $password);

    $response = $this->make_get_petition($token, $document->id);

    $response
      ->assertStatus(404)
      ->assertExactJson(['message' => 'Document not exist.']);
  }

  public function test_return_document_when_user_logged_and_have_this_document()
  {
    [$user_group, $document, $user, $token, $password, $tags] = get_user_group_document_user_and_token_after_login($this);

    $token = do_login_and_get_token($this, $user->email, $password);

    $response = $this->make_get_petition($token, $document->id);

    $response
      ->assertStatus(200)
      ->assertJson(['document' => get_document_structure_to_assert($document)])
      ->assertJson(['document' => [
        'tags' => [
          $tags[0]->name
        ]
      ]]);
  }

  private function make_get_petition($token = '', $document_id = 1)
  {
    $endpoint = '/api/documents/' . $document_id;
    return $this->withHeaders(['Authorization' => 'Bearer ' . $token])
      ->json('GET', $endpoint);
  }
}
