<?php

namespace Docuco\Domain\Documents\Actions;

use Docuco\Domain\Documents\Repositories\DocumentsRepository;
use Docuco\Domain\Documents\Collections\DocumentCollection;

class GetAllDocumentsAction
{
    private $repository;

    public function __construct(DocumentsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $user_group_id): DocumentCollection
    {
        return $this->repository->get_all_documents_by_user_group_id($user_group_id);
    }
}
