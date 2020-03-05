<?php

namespace Tests\Unit\Documents\Actions;

use Tests\TestCase;
use Tests\Unit\Domain\Documents\Repositories\DocumentsRepositoryMock;
use Tests\Unit\Helpers\DocumentHelper;
use Docuco\Domain\Documents\Actions\GetAllDocumentsAction;
use Docuco\Domain\Documents\Entities\Document;

class GetAllDocumentsUnitTest extends TestCase
{
    private $documents_repository;

    protected function setUp(): void
    {
        $this->documents_repository = new DocumentsRepositoryMock();
    }

    public function test_return_empty_array_when_not_have_documents()
    {
        $user_group_id = 1;
        $document = DocumentHelper::get_random_document();
        $this->documents_repository->add_document($document->id, $document);
        $get_all_documents_action = new GetAllDocumentsAction($this->documents_repository);

        $document_base_collection_response = $get_all_documents_action->execute($user_group_id, $document->id);

        $this->assertEquals([], $document_base_collection_response->all());
    }

    public function test_return_array_with_documents_when_user_have_this_documents()
    {
        [$user_group, $document] = DocumentHelper::get_user_group_and_his_document($this->documents_repository);
        $get_all_documents_action = new GetAllDocumentsAction($this->documents_repository);

        $document_base_collection_response = $get_all_documents_action->execute($user_group->id, $document->id);

        $this->assertCount(1, $document_base_collection_response->all());
    }
}
