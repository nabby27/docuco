<?php

namespace Tests\Unit\Documents\Actions;

use Tests\TestCase;
use Tests\Unit\Domain\Documents\Repositories\DocumentsRepositoryMock;
use Docuco\Domain\Documents\Actions\DeleteDocumentAction;
use Tests\Unit\Helpers\DocumentHelper;

class DeleteDocumentUnitTest extends TestCase
{
  private $documents_repository;

  protected function setUp(): void
  {
    $this->documents_repository = new DocumentsRepositoryMock();
  }

  public function test_return_false_when_not_have_document()
  {
    $user_group_id = 1;
    $document = DocumentHelper::get_random_document();
    $this->documents_repository->add_document($document);
    $delete_document_action = new DeleteDocumentAction($this->documents_repository);

    $response = $delete_document_action->execute($user_group_id, $document->id);

    $this->assertEquals(false, $response);
  }

  public function test_return_true_when_user_delete_document_that_have()
  {
    [$user_group, $document] = DocumentHelper::get_user_group_and_his_document($this->documents_repository);
    $this->documents_repository->add_document($document, $user_group->id);
    $delete_document_action = new DeleteDocumentAction($this->documents_repository);

    $response = $delete_document_action->execute($user_group->id, $document->id);

    $this->assertEquals(true, $response);
  }
}
