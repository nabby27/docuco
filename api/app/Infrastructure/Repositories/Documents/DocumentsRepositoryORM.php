<?php

namespace Docuco\Infrastructure\Repositories\Documents;

use Docuco\Models\DocumentModel;
use Docuco\Models\DocumentTagModel;
use Docuco\Domain\Documents\Repositories\DocumentsRepository;
use Docuco\Domain\Documents\Collections\DocumentCollection;
use Docuco\Domain\Documents\Entities\Document;
use Docuco\Models\TagModel;
use Docuco\Models\TypeModel;

class DocumentsRepositoryORM implements DocumentsRepository
{

  private $document_model;

  public function __construct()
  {
    $this->document_model = new DocumentModel();
    $this->document_tag_model = new DocumentTagModel();
    $this->tag_model = new TagModel();
    $this->type_model = new TypeModel();
  }

  public function get_one_document_by_user_group_id(int $user_group_id, int $document_id): ?Document
  {
    $document_model = $this->get_one_document_model_by_user_group($user_group_id, $document_id);

    if (isset($document_model)) {
      return Document::get_from_model($document_model);
    }

    return null;
  }

  public function get_all_documents_by_user_group_id(int $user_group_id): DocumentCollection
  {
    $document_model_collection = $this->document_model
      ->where('user_group_id', $user_group_id)
      ->get();

    $document_collection = new DocumentCollection();
    foreach ($document_model_collection as $document_model) {
      $document_collection->add(
        Document::get_from_model($document_model)
      );
    }

    return $document_collection;
  }

  public function create_document_by_user_group_id(int $user_group_id, $document_to_create): ?Document
  {
    $this->document_model->user_group_id = $user_group_id;
    $this->document_model->type_id = $this->type_model->where('name', $document_to_create['type'])->first()->id;

    foreach ($document_to_create as $property => $value) {
      if ($property != 'id' && $property != 'type' && $property != 'tags') {
        $this->document_model->$property = $value;
      }
    }

    $this->document_model->save();

    return Document::get_from_model($this->document_model);
  }

  public function update_document_by_user_group_id(int $user_group_id, $document): ?Document
  {
    $document_model = $this->get_one_document_model_by_user_group($user_group_id, $document->id);
    $document_model->type_id = $this->type_model->where('name', $document->type)->first()->id;

    if (isset($document_model)) {
      foreach ($document as $property => $value) {
        if ($property != 'tags' && $property != 'type' && $property != 'url') {
          $document_model->$property = $value;
        }
      }

      $is_updated = $document_model->update();

      if ($is_updated) {
        return Document::get_from_model($document_model);
      }
    }

    return null;
  }

  public function delete_document_by_user_group_id(int $user_group_id, int $document_id): bool
  {
    $document_model = $this->get_one_document_model_by_user_group($user_group_id, $document_id);


    if (isset($document_model)) {
      $this->delete_relation_with_tags_by_document_model($document_model->id);
      $is_deleted = $document_model->delete();
      return $is_deleted;
    }

    return false;
  }

  private function get_one_document_model_by_user_group(int $user_group_id, int $document_id): ?DocumentModel
  {
    return $this->document_model
      ->where('user_group_id', $user_group_id)
      ->find($document_id);
  }

  private function delete_relation_with_tags_by_document_model(int $document_id)
  {
    $this->document_tag_model->where('document_id', $document_id)->delete();
  }
}
