<?php

namespace Tests\Unit\Documents\Actions;

use Tests\TestCase;
use Tests\Unit\Domain\Documents\Repositories\DocumentsRepositoryMock;
use Docuco\Domain\Documents\Actions\CreateDocumentAction;
use Tests\Unit\Helpers\DocumentHelper;

class CreateDocumentUnitTest extends TestCase
{
  private $documents_repository;

  protected function setUp(): void
  {
    $this->documents_repository = new DocumentsRepositoryMock();
  }

  public function test_return_document_after_create()
  {
    [$user_group, $document] = DocumentHelper::get_user_group_and_his_document($this->documents_repository);
    $this->documents_repository->add_document($document, $user_group->id);
    $create_document_action = new CreateDocumentAction($this->documents_repository);

    $response = $create_document_action->execute($user_group->id, $document);

    $this->assertEquals($document, $response);
  }
}
