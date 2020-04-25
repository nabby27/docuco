<?php

namespace Docuco\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Docuco\Infrastructure\Repositories\Documents\DocumentsRepositoryPostgreSQL;
use Docuco\Infrastructure\Services\GetUserGroupIdFromRequestService;
use Docuco\Domain\Documents\Actions\GetIncomeAndExpensesDataToGenericChartAction;
use Docuco\Domain\Documents\Actions\GetDocumentsDataPieChartAction;
use Docuco\Domain\Documents\Actions\GetBenefitDataToGenericChartAction;

class ChartController extends Controller
{
    private $document_repository;

    public function __construct()
    {
        $this->document_repository = new DocumentsRepositoryPostgreSQL();
        $this->get_user_group_id_from_request_service = new GetUserGroupIdFromRequestService();
    }

    public function get_benefit_data_generic_chart(Request $request)
    {
        $user_group_id = $this->get_user_group_id_from_request_service->execute($request);
        $getBenefitDataToGenericChartAction = new GetBenefitDataToGenericChartAction($this->document_repository);
        $data_chart = $getBenefitDataToGenericChartAction->execute($user_group_id);

        return response()->json(['data_chart' => $data_chart], 200);
    }

    public function get_documents_data_bar_chart(Request $request)
    {
        $user_group_id = $this->get_user_group_id_from_request_service->execute($request);
        $getIncomeAndExpensesDataToGenericChartAction = new GetIncomeAndExpensesDataToGenericChartAction($this->document_repository);
        $data_chart = $getIncomeAndExpensesDataToGenericChartAction->execute($user_group_id);

        return response()->json(['data_chart' => $data_chart], 200);
    }

    public function get_documents_data_pie_chart(Request $request)
    {
        $user_group_id = $this->get_user_group_id_from_request_service->execute($request);
        $get_documents_data_pie_chart_action = new GetDocumentsDataPieChartAction($this->document_repository);
        $data_chart = $get_documents_data_pie_chart_action->execute($user_group_id);

        return response()->json(['data_chart' => $data_chart], 200);
    }

}
