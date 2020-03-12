<?php

namespace Tests\Unit\Domain\Documents\Repositories;

use Docuco\Domain\Documents\Repositories\DocumentsRepository;
use Docuco\Domain\Documents\Collections\DocumentCollection;
use Docuco\Domain\Documents\Entities\Document;

class DocumentsRepositoryMock implements DocumentsRepository
{
  private $documents = [];

  public function add_document(Document $document, int $user_group_id = -1)
  {
    $this->documents[$user_group_id][$document->id] = $document;
  }

  public function get_one_document_by_user_group_id(int $user_group_id, int $document_id): ?Document
  {
    if (isset($this->documents[$user_group_id])) {
      return $this->documents[$user_group_id][$document_id];
    }

    return null;
  }

  public function get_all_documents_by_user_group_id(int $user_group_id): DocumentCollection
  {
    $document_collection = new DocumentCollection();
    if (isset($this->documents[$user_group_id])) {
      foreach ($this->documents[$user_group_id] as $document_id => $document) {
        $document_collection->add(new Document(
          $document->id,
          $document->name,
          $document->description,
          [],
          $document->price,
          $document->url,
          $document->date_of_issue
        ));
      }
    }
    return $document_collection;
  }

  public function create_document_by_user_group_id(int $user_group_id, $document_to_create): ?Document
  {
    return $document_to_create;
  }

  public function update_document_by_user_group_id(int $user_group_id, $document_to_update): ?Document
  {
    if (isset($this->documents[$user_group_id])) {
      return $this->documents[$user_group_id][$document_to_update->id];
    }

    return null;
  }

  public function delete_document_by_user_group_id(int $user_group_id, int $document_id): bool
  {
    if (isset($this->documents[$user_group_id])) {
      return true;
    }

    return false;
  }
}
