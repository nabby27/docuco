<?php

namespace Docuco\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DocumentTagModel extends Model
{
    protected $table = 'documents_tags';

    protected $primaryKey = ['document_id', 'tag_id'];
    public $incrementing = false;

  /**
   * Set the keys for a save update query.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  /**
   * @codeCoverageIgnore
   */
    protected function setKeysForSaveQuery(Builder $query)
    {
        $keys = $this->getKeyName();
        if (!is_array($keys)) {
            return parent::setKeysForSaveQuery($query);
        }

        foreach ($keys as $keyName) {
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

  /**
   * Get the primary key value for a save query.
   *
   * @param mixed $keyName
   * @return mixed
   */
  /**
   * @codeCoverageIgnore
   */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if (is_null($keyName)) {
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }

  // public function document()
  // {
  //     return $this->belongsTo('Docuco\Models\DocumentModel');
  // }

  // public function tag()
  // {
  //     return $this->belongsTo('Docuco\Models\TagModel');
  // }
}
