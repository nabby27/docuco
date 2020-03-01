<?php

namespace Docuco\Domain\Documents\Repositories;

use Docuco\Domain\Documents\Collections\DocumentCollection;
use Docuco\Domain\Documents\Entities\Document;

interface DocumentsRepository
{
    public function get_all_documents_by_users_group_id(int $users_group_id): DocumentCollection;
    public function get_one_document_by_users_group_id(int $users_group_id, int $document_id): ?Document;
}
