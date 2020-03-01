<?php

namespace Docuco\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Docuco\Infrastructure\Repositories\Documents\DocumentsRepositoryORM;
use Docuco\Infrastructure\Services\GetUsersGroupIdFromRequestService;
use Docuco\Domain\Documents\Actions\GetAllDocumentsAction;
use Docuco\Domain\Documents\Actions\GetOneDocumentAction;

class DocumentController extends Controller
{
    private $document_repository;

    public function __construct()
    {
        $this->document_repository = new DocumentsRepositoryORM();
        $this->get_users_group_id_from_request_service = new GetUsersGroupIdFromRequestService();
    }
    
    public function getAllDocuments(Request $request)
    {
        $users_group_id = $this->get_users_group_id_from_request_service->execute($request);
        $get_all_documents_action = new GetAllDocumentsAction($this->document_repository);
        $document_collection = $get_all_documents_action->execute($users_group_id);
        return response()->json(['documents' => $document_collection->all()], 200);
    }

    public function getOneDocument(Request $request, int $document_id)
    {
        $users_group_id = $this->get_users_group_id_from_request_service->execute($request);
        $get_one_document_action = new GetOneDocumentAction($this->document_repository);
        $document = $get_one_document_action->execute($users_group_id, $document_id);

        if (isset($document)) {
            return response()->json(['document' => $document], 200);
        }
        return response()->json(['message' => 'Document not exist.'], 404);
    }

    public function updateDocument(Request $request, int $document_id)
    {
    }
}
