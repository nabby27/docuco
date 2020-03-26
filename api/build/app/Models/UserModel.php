<?php

namespace Docuco\Models;

use Illuminate\Foundation\Auth\User;
use Laravel\Passport\HasApiTokens;

class UserModel extends User
{
    use HasApiTokens;

    protected $table = 'users';

    public function user_group()
    {
        return $this->belongsTo('Docuco\Models\UserGroupModel');
    }

    public function role()
    {
        return $this->belongsTo('Docuco\Models\RoleModel');
    }

  // public function blocked_documents()
  // {
  //     return $this->hasMany('Docuco\Models\UserBlockedDocumentModel', 'user_id');
  // }

  // public function blocked_tags()
  // {
  //     return $this->hasMany('Docuco\Models\UserBlockedTagModel', 'user_id');
  // }
}
