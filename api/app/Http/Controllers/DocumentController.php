<?php

namespace Docuco\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Docuco\Infrastructure\Repositories\Documents\DocumentsRepositoryORM;
use Docuco\Infrastructure\Services\GetUserGroupIdFromRequestService;
use Docuco\Domain\Documents\Actions\GetAllDocumentsAction;
use Docuco\Domain\Documents\Actions\GetOneDocumentAction;
use Docuco\Domain\Documents\Actions\CreateDocumentAction;
use Docuco\Domain\Documents\Actions\UpdateDocumentAction;
use Docuco\Domain\Documents\Actions\DeleteDocumentAction;

class DocumentController extends Controller
{
    private $document_repository;

    public function __construct()
    {
        $this->document_repository = new DocumentsRepositoryORM();
        $this->get_user_group_id_from_request_service = new GetUserGroupIdFromRequestService();
    }

    public function get_all_documents(Request $request)
    {
        $user_group_id = $this->get_user_group_id_from_request_service->execute($request);
        $get_all_documents_action = new GetAllDocumentsAction($this->document_repository);
        $document_collection = $get_all_documents_action->execute($user_group_id);
        return response()->json(['documents' => $document_collection->all()], 200);
    }

    public function get_one_document(Request $request, int $document_id)
    {
        $user_group_id = $this->get_user_group_id_from_request_service->execute($request);
        $get_one_document_action = new GetOneDocumentAction($this->document_repository);
        $document = $get_one_document_action->execute($user_group_id, $document_id);

        if (isset($document)) {
            return response()->json(['document' => $document], 200);
        }
        return response()->json(['message' => 'Document not exist.'], 404);
    }

    public function create_document(Request $request)
    {
        $new_document = json_decode($request->getContent());
        $user_group_id = $this->get_user_group_id_from_request_service->execute($request);

        $create_document_action = new CreateDocumentAction($this->document_repository);
        $document_created = $create_document_action->execute($user_group_id, $new_document);

        return response()->json(['document' => $document_created], 200);
    }

    public function update_document(Request $request, int $document_id)
    {
        $document_to_update = json_decode($request->getContent());
        if ($document_to_update->id !== $document_id) {
            return response()->json(['message' => 'Document id on object not match with id in url.'], 400);
        }

        $user_group_id = $this->get_user_group_id_from_request_service->execute($request);

        $update_document_action = new UpdateDocumentAction($this->document_repository);
        $document_updated = $update_document_action->execute($user_group_id, $document_to_update);

        if (isset($document_updated)) {
            return response()->json(['document' => $document_updated], 200);
        }

        return response()->json(['message' => 'Document not exist.'], 404);
    }

    public function delete_document(Request $request, int $document_id)
    {
        $user_group_id = $this->get_user_group_id_from_request_service->execute($request);

        $delete_document_action = new DeleteDocumentAction($this->document_repository);
        $is_deleted = $delete_document_action->execute($user_group_id, $document_id);

        if ($is_deleted) {
            return response()->json(['message' => 'Document deleted successfully.'], 200);
        }

        return response()->json(['message' => 'Document not exist.'], 404);
    }
}
