<?php

namespace Docuco\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Docuco\Infrastructure\Repositories\Documents\DocumentsRepositoryORM;
use Docuco\Infrastructure\Services\GetUsersGroupIdFromRequestService;
use Docuco\Domain\Documents\Actions\GetAllDocumentsAction;
use Docuco\Domain\Documents\Actions\GetOneDocumentAction;
use Docuco\Domain\Documents\Actions\UpdateDocumentAction;
use Docuco\Domain\Documents\Entities\Document;

class DocumentController extends Controller
{
    private $document_repository;

    public function __construct()
    {
        $this->document_repository = new DocumentsRepositoryORM();
        $this->get_users_group_id_from_request_service = new GetUsersGroupIdFromRequestService();
    }
    
    public function get_all_documents(Request $request)
    {
        $users_group_id = $this->get_users_group_id_from_request_service->execute($request);
        $get_all_documents_action = new GetAllDocumentsAction($this->document_repository);
        $document_collection = $get_all_documents_action->execute($users_group_id);
        return response()->json(['documents' => $document_collection->all()], 200);
    }

    public function get_one_document(Request $request, int $document_id)
    {
        $users_group_id = $this->get_users_group_id_from_request_service->execute($request);
        $get_one_document_action = new GetOneDocumentAction($this->document_repository);
        $document = $get_one_document_action->execute($users_group_id, $document_id);

        if (isset($document)) {
            return response()->json(['document' => $document], 200);
        }
        return response()->json(['message' => 'Document not exist.'], 404);
    }

    public function update_document(Request $request, int $document_id)
    {
        $document_to_update = json_decode($request->getContent());
        if ($document_to_update->id !== $document_id) {
            return response()->json(['message' => 'Document id on object not match with id in url.'], 400);
        }

        $users_group_id = $this->get_users_group_id_from_request_service->execute($request);
        $update_document_action = new UpdateDocumentAction($this->document_repository);
        $document = $update_document_action->execute($users_group_id, $document_to_update);

        if (isset($document)) {
            return response()->json(['document' => $document], 200);
        }

        return response()->json(['message' => 'Document not exist.'], 404);
    }
}
