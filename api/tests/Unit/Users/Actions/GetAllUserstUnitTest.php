<?php

namespace Tests\Unit\Users\Actions;

use Docuco\Domain\Users\Actions\GetAllUsersAction;
use Docuco\Domain\Users\Entities\User;
use Tests\TestCase;
use Tests\Unit\Domain\Users\Repositories\UsersRepositoryMock;
use Tests\Unit\Helpers\UserHelper;

// use Tests\Unit\Domain\Documents\Repositories\DocumentsRepositoryMock;
// use Tests\Unit\Helpers\DocumentHelper;
// use Docuco\Domain\Documents\Actions\GetAllDocumentsAction;

class GetAllUsersUnitTest extends TestCase
{
  private $users_repository;

  protected function setUp(): void
  {
    $this->users_repository = new UsersRepositoryMock();
  }

  public function test_return_empty_array_when_not_exist_users()
  {
    $user_group_id = 1;
    $get_all_users_action = new GetAllUsersAction($this->users_repository);

    $user_collection_response = $get_all_users_action->execute($user_group_id);

    $this->assertEquals([], $user_collection_response->all());
  }

  public function test_return_array_with_users_when_exist_users()
  {
    $user_group_id = 1;
    $this->add_user_on_repository_for_user_group(1, $user_group_id);
    $this->add_user_on_repository_for_user_group(2, $user_group_id);

    $get_all_users_action = new GetAllUsersAction($this->users_repository);
    $user_collection_response = $get_all_users_action->execute($user_group_id);

    $this->assertCount(2, $user_collection_response->all());
  }

  private function add_user_on_repository_for_user_group($user_id, $user_group_id): User
  {
    $user = UserHelper::get_random_user($user_id, $user_group_id);
    $this->users_repository->add_user($user, $user_group_id);

    return $user;
  }
}
