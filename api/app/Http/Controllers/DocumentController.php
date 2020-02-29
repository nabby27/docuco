<?php

namespace Docuco\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Docuco\Infrastructure\Repositories\Documents\DocumentsRepositoryORM;
use Docuco\Infrastructure\Services\GetUsersGroupIdFromRequestService;
use Docuco\Domain\Documents\Actions\GetDocumentsAction;

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
        $get_documents_action = new GetDocumentsAction($this->document_repository);
        $document_collection = $get_documents_action->execute($users_group_id);
        return response()->json(['documents' => $document_collection->all()], 200);
    }
}
