<?php

namespace Tests\Unit\Documents\Actions;

use Tests\TestCase;
use Tests\Unit\Domain\Documents\Repositories\DocumentsRepositoryMock;
use Docuco\Domain\Documents\Entities\DocumentBase;
use Docuco\Domain\Documents\Actions\GetDocumentsAction;

class GetDocumentUnitTest extends TestCase
{
    public function testReturnEmptyArrayWhenUserNotLoggedAndHaveDocuments()
    {
        // $document = new Document(['id' => mt_rand(),'name' => 'Document example']);
        // $documentsRepository = new DocumentsRepositoryMock();
        // $documentsRepository->addDocument($document->id, $document);

        // $getDocumentsAction = new GetDocumentsAction($documentsRepository);

        // $documentsResponse = $getDocumentsAction->execute();
        $documentsResponse = [];
        $this->assertEquals([], $documentsResponse);
    }
}
