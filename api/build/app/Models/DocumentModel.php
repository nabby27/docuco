<?php

namespace Docuco\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentModel extends Model
{
    protected $table = 'documents';

    public function documents_tags()
    {
        return $this->hasMany('Docuco\Models\DocumentTagModel', 'document_id');
    }

    public function type()
    {
        return $this->belongsTo('Docuco\Models\TypeModel', 'type_id');
    }

  // public function user_group()
  // {
  //     return $this->belongsTo('Docuco\Models\UserGroupModel', 'user_group_id');
  // }

    protected $casts = [
    'price' => 'float',
    ];
}
