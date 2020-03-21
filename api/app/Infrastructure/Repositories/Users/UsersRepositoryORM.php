<?php

namespace Docuco\Infrastructure\Repositories\Users;

use Docuco\Models\UserModel;
use Docuco\Domain\Users\Entities\User;
use Docuco\Domain\Users\Repositories\UsersRepository;
use Docuco\Domain\Users\Collections\UserCollection;
use Docuco\Models\RoleModel;

class UsersRepositoryORM implements UsersRepository
{

  private $user_model;

  public function __construct()
  {
    $this->user_model = new UserModel();
    $this->role_model = new RoleModel();
  }

  public function get_one_user_by_user_group_id(int $user_group_id, int $user_id): ?User
  {
    $user_model = $this->get_one_user_model_by_user_group($user_group_id, $user_id);

    if (isset($user_model)) {
      return User::get_from_model($user_model);
    }

    return null;
  }

  public function get_all_users_by_user_group_id(int $user_group_id): UserCollection
  {
    $user_model_collection = $this->user_model
      ->where('user_group_id', $user_group_id)
      ->get();

    $uder_collection = new UserCollection();
    foreach ($user_model_collection as $user_model) {
      $uder_collection->add(
        User::get_from_model($user_model)
      );
    }

    return $uder_collection;
  }

  public function create_user_by_user_group_id(int $user_group_id, $user_to_create): ?User
  {
    $this->user_model->user_group_id = $user_group_id;
    $this->user_model->role_id = $this->role_model->where('name', $user_to_create->role)->first()->id;

    foreach ($user_to_create as $property => $value) {
      if ($property != 'id' && $property != 'role') {
        $this->user_model->$property = $value;
      }
    }

    $this->user_model->password = bcrypt('123456');

    $this->user_model->save();

    return User::get_from_model($this->user_model);
  }

  public function update_user_by_user_group_id(int $user_group_id, $user): ?User
  {
    $user_model = $this->get_one_user_model_by_user_group($user_group_id, $user->id);
    if (isset($user_model)) {
      $user_model->role_id = $this->role_model->where('name', $user->role)->first()->id;
      foreach ($user as $property => $value) {
        if ($property != 'id' && $property != 'role' && $property != 'user_group') {
          $user_model->$property = $value;
        }
      }

      $is_updated = $user_model->save();

      if ($is_updated) {
        return User::get_from_model($user_model);
      }
    }

    return null;
  }

  public function delete_user_by_user_group_id(int $user_group_id, int $user_id): bool
  {
    $user_model = $this->get_one_user_model_by_user_group($user_group_id, $user_id);

    if (isset($user_model)) {
      $is_deleted = $user_model->delete();
      return $is_deleted;
    }

    return false;
  }

  private function get_one_user_model_by_user_group(int $user_group_id, int $user_id): ?UserModel
  {
    return $this->user_model
      ->where('user_group_id', $user_group_id)
      ->find($user_id);
  }
}
