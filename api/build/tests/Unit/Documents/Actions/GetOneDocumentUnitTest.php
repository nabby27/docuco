<?php

namespace Tests\Unit\Documents\Actions;

use Tests\TestCase;
use Tests\Unit\Domain\Documents\Repositories\DocumentsRepositoryMock;
use Docuco\Domain\Documents\Actions\GetOneDocumentAction;
use Tests\Unit\Helpers\DocumentHelper;

class GetOneDocumentUnitTest extends TestCase
{
    private $documents_repository;

    protected function setUp(): void
    {
        $this->documents_repository = new DocumentsRepositoryMock();
    }

    public function test_return_null_when_not_have_document()
    {
        $user_group_id = 1;
        $document = DocumentHelper::get_random_document();
        $this->documents_repository->add_document($document);
        $get_one_document_action = new GetOneDocumentAction($this->documents_repository);

        $documents_response = $get_one_document_action->execute($user_group_id, $document->id);

        $this->assertEquals(null, $documents_response);
    }

    public function test_return_document_when_user_have_this_document()
    {
        [$user_group, $document] = DocumentHelper::get_user_group_and_his_document($this->documents_repository);
        $this->documents_repository->add_document($document, $user_group->id);
        $get_one_document_action = new GetOneDocumentAction($this->documents_repository);

        $documents_response = $get_one_document_action->execute($user_group->id, $document->id);

        $this->assertEquals($document, $documents_response);
    }
}
