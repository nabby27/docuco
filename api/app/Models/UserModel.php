<?php

namespace Docuco\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'users';

    public function group()
    {
        return $this->belongsTo('Docuco\Models\UserGroupModel');
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
