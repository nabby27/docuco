<?php

namespace Docuco\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroupModel extends Model
{
  protected $table = 'user_groups';

  // public function users()
  // {
  //     return $this->hasMany('Docuco\Models\UserModel', 'user_group_id');
  // }

  // public function documents()
  // {
  //     return $this->hasMany('Docuco\Models\DocumentModel', 'user_group_id');
  // }
}
