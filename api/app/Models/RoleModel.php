<?php

namespace Docuco\Models;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    protected $table = 'roles';
    
    // public function users()
    // {
    //     return $this->hasMany('Docuco\Models\UserModel', 'role_id');
    // }
}
