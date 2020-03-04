<?php

namespace Docuco\Domain\Documents\Repositories;

use Docuco\Domain\Documents\Collections\DocumentBaseCollection;
use Docuco\Domain\Documents\Entities\DocumentBase;
use Docuco\Domain\Documents\Entities\Document;

interface DocumentsRepository
{
    public function get_all_documents_by_users_group_id(int $users_group_id): DocumentBaseCollection;
    public function get_one_document_by_users_group_id(int $users_group_id, int $document_id): ?Document;
    public function create_document_by_users_group_id(int $users_group_id, $document_to_create): ?DocumentBase;
    public function update_document_by_users_group_id(int $users_group_id, $document_to_update): ?DocumentBase;
    public function delete_document_by_users_group_id(int $users_group_id, int $document_id): bool;
}
