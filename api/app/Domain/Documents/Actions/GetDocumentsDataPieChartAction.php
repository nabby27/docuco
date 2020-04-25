<?php

namespace Docuco\Domain\Documents\Actions;

use Docuco\Domain\Documents\Repositories\DocumentsRepository;
use Docuco\Domain\Documents\Entities\IncomeExpensesDataPieChart;

class GetDocumentsDataPieChartAction
{
    private $repository;

    public function __construct(DocumentsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $user_group_id): IncomeExpensesDataPieChart
    {
        $documents = $this->repository->get_all_documents_by_user_group_id($user_group_id);
        $labels = ['Ingresos', 'Gastos'];
        $data = [null, null];

        foreach ($documents->all() as $document) {
            $year = date("Y", strtotime($document->date_of_issue));
            if (date("Y") === $year) {
                if ($document->type === 'INCOME') {
                    $data[0] += $document->price;
                }
                if ($document->type === 'EXPENSE') {
                    $data[1] += $document->price;
                }
            }
        }

        return new IncomeExpensesDataPieChart($labels, $data);
    }
}
