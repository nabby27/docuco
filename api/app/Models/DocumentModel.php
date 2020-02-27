<?php

namespace Docuco\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentModel extends Model
{
    protected $table = 'documents';

    public function types()
    {
        return $this->hasMany('Docuco\Models\DocumentTypeModel', 'document_id');
    }

    public function users_group()
    {
        return $this->belongsTo('Docuco\Models\UserGroupModel', 'users_group_id');
    }
}
