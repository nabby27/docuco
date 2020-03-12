<?php

namespace Docuco\Domain\Documents\Actions;

use Docuco\Domain\Documents\Repositories\DocumentsRepository;
use Docuco\Domain\Documents\Collections\DocumentCollection;

class GetAllDocumentsAction
{
  private $documents_repository;

  public function __construct(DocumentsRepository $documents_repository)
  {
    $this->documents_repository = $documents_repository;
  }

  public function execute(int $user_group_id): DocumentCollection
  {
    return $this->documents_repository->get_all_documents_by_user_group_id($user_group_id);
  }
}
