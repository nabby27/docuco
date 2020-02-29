<?php

namespace Docuco\Domain\Documents\Repositories;

use Docuco\Domain\Documents\Collections\DocumentCollection;

interface DocumentsRepository
{
    public function get_documents_by_users_group_id(int $users_group_id): DocumentCollection;
}
