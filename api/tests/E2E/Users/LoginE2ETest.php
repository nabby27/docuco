<?php

namespace Tests\E2E;

use Docuco\Domain\Users\Constants\RoleConstants;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserE2ETest extends TestCase
{
  use DatabaseTransactions;

  public function test_login_fail_without_parameters()
  {
    $response = $this->json('POST', '/api/login', []);

    $response
      ->assertStatus(401)
      ->assertExactJson(['message' => 'You have entered an invalid username or password.']);
  }

  public function test_login_fail_when_not_exist_user()
  {
    $response = $this->json('POST', '/api/login', [
      'email' => 'test@test.com',
      'password' => '1234'
    ]);

    $response
      ->assertStatus(401)
      ->assertExactJson(['message' => 'You have entered an invalid username or password.']);
  }

  public function test_login_success_when_user_exist()
  {
    $user_group = create_user_group();
    $password = '123456';
    $role_name = RoleConstants::EDIT;
    $user = create_user($user_group, $role_name, $password);

    $response = $this->json('POST', '/api/login', [
      'email' => $user->email,
      'password' => $password
    ]);

    $response
      ->assertStatus(200)
      ->assertJsonStructure(['token']);
  }
}
