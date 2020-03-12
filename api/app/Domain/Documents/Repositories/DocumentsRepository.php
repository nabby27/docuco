<?php

namespace Docuco\Domain\Documents\Repositories;

use Docuco\Domain\Documents\Collections\DocumentCollection;
use Docuco\Domain\Documents\Entities\Document;

interface DocumentsRepository
{
  public function get_one_document_by_user_group_id(int $user_group_id, int $document_id): ?Document;
  public function get_all_documents_by_user_group_id(int $user_group_id): DocumentCollection;
  public function create_document_by_user_group_id(int $user_group_id, $document_to_create): ?Document;
  public function update_document_by_user_group_id(int $user_group_id, $document_to_update): ?Document;
  public function delete_document_by_user_group_id(int $user_group_id, int $document_id): bool;
}
