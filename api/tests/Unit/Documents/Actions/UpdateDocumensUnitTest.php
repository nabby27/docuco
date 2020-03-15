<?php

namespace Tests\Unit\Documents\Actions;

use Tests\TestCase;
use Tests\Unit\Domain\Documents\Repositories\DocumentsRepositoryMock;
use Tests\Unit\Helpers\DocumentHelper;
use Docuco\Domain\Documents\Actions\UpdateDocumentAction;
use Docuco\Domain\Documents\Entities\Document;

class UpdateDocumentUnitTest extends TestCase
{
  private $documents_repository;

  protected function setUp(): void
  {
    $this->documents_repository = new DocumentsRepositoryMock();
  }

  public function test_return_null_when_not_have_this_document()
  {
    $user_group_id = 1;
    $document = DocumentHelper::get_random_document();
    $this->documents_repository->add_document($document);
    $update_document_action = new UpdateDocumentAction($this->documents_repository);

    $updated_document = $update_document_action->execute($user_group_id, $document);

    $this->assertEquals(null, $updated_document);
  }

  public function test_return_document_when_user_update_this_document()
  {
    [$user_group, $document] = DocumentHelper::get_user_group_and_his_document($this->documents_repository);
    $update_document_action = new UpdateDocumentAction($this->documents_repository);

    $updated_document = $update_document_action->execute($user_group->id, $document);

    $this->assertEquals($document, $updated_document);
  }
}
