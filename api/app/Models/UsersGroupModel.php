<?php

namespace Docuco\Models;

use Illuminate\Database\Eloquent\Model;

class UsersGroupModel extends Model
{
    protected $table = 'users_groups';

    // public function users()
    // {
    //     return $this->hasMany('Docuco\Models\UserModel', 'users_group_id');
    // }

    // public function documents()
    // {
    //     return $this->hasMany('Docuco\Models\DocumentModel', 'users_group_id');
    // }
}
