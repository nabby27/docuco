<?php

namespace Docuco\Models;

use Illuminate\Foundation\Auth\User;

class UserModel extends User
{
    protected $table = 'users';

    public function group()
    {
        return $this->belongsTo('Docuco\Models\UsersGroupModel');
    }

    public function role()
    {
        return $this->belongsTo('Docuco\Models\RoleModel');
    }
    
    public function blockedDocuments()
    {
        return $this->hasMany('Docuco\Models\UserBlockedDocumentModel', 'user_id');
    }

    public function blockedTypes()
    {
        return $this->hasMany('Docuco\Models\UserBlockedTypeModel', 'user_id');
    }
}
