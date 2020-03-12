<?php

namespace Tests\Unit\Documents\Actions;

use Tests\TestCase;
use Tests\Unit\Domain\Users\Repositories\UsersRepositoryMock;
use Docuco\Domain\Users\Actions\GetOneUserAction;
use Docuco\Domain\Users\Entities\User;
use Tests\Unit\Helpers\UserHelper;

class GetOneUserUnitTest extends TestCase
{
  private $users_repository;

  protected function setUp(): void
  {
    $this->users_repository = new UsersRepositoryMock();
  }

  public function test_return_null_when_user_not_exist()
  {
    $user_group_id = 1;
    $user_id = 1;
    $get_one_user_action = new GetOneUserAction($this->users_repository);

    $users_response = $get_one_user_action->execute($user_group_id, $user_id);

    $this->assertEquals(null, $users_response);
  }

  public function test_return_user_when_exist_in_his_group()
  {
    $user_group_id = 1;
    $user_id = 1;
    $user = UserHelper::get_random_user($user_id, $user_group_id);
    $this->users_repository->add_user($user, $user_group_id);
    $get_one_user_action = new GetOneUserAction($this->users_repository);

    $users_response = $get_one_user_action->execute($user_group_id, $user_id);

    $this->assertEquals($user, $users_response);
  }
}
