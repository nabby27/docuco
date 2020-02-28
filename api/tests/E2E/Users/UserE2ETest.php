<?php

namespace Tests\E2E;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserE2ETest extends TestCase
{
  use DatabaseTransactions;

  public function testLoginFailWithoutParameters()
  {
    $response = $this->json('POST', '/api/login', []);

    $response
      ->assertStatus(401)
      ->assertExactJson(['message' => 'Unauthenticated']);
  }

  public function testLoginFailWhenNotExistUser()
  {
    $response = $this->json('POST', '/api/login', [
      'email' => 'test@test.com', 
      'password' => '1234'
    ]);

    $response
      ->assertStatus(401)
      ->assertExactJson(['message' => 'Unauthenticated']);
  }

  public function testLoginSuccessWhenUserExist()
  {
    $email = 'test@test.com';
    $password = '123456';
    $role = $this->createRole();
    $users_group = $this->createUsersGroup();
    $user = $this->createUser($users_group->id, $role->id, $email, $password);

    $response = $this->json('POST', '/api/login', [
      'email' => $email,
      'password' => $password
    ]);

    $response
      ->assertStatus(200)
      ->assertExactJson(['token' => 'token_example']);
  }

  private function createUser(int $users_group_id, int $role_id, string $email, string $password) {
    return factory('Docuco\Models\UserModel'::class)->create([
      'email' => $email,
      'password' => bcrypt($password),
      'users_group_id' => $users_group_id,
      'role_id' => $role_id,
    ]);
  }

  private function createUsersGroup() 
  {
    return factory('Docuco\Models\UsersGroupModel'::class)->create();
  }

  private function createRole() 
  {
    return factory('Docuco\Models\RoleModel'::class)->create();
  }

}
