<?php

namespace Docuco\Domain\Documents\Actions;

use Docuco\Domain\Documents\Repositories\DocumentsRepository;
use Docuco\Domain\Documents\Entities\DataGenericChart;

class GetIncomeAndExpensesDataToGenericChartAction
{
    private $repository;

    public function __construct(DocumentsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $user_group_id): DataGenericChart
    {
        $documents = $this->repository->get_all_documents_by_user_group_id($user_group_id);
        $labels = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
        $income_data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $expenses_data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        foreach ($documents->all() as $document) {
            $year = date("Y", strtotime($document->date_of_issue));
            $month = date("n", strtotime($document->date_of_issue));
            if (date("Y") === $year) {
                if ($document->type === 'INCOME') {
                    $income_data[$month - 1] += $document->price;
                }
                if ($document->type === 'EXPENSE') {
                    $expenses_data[$month - 1] += $document->price;
                }
            }
        }

        $incomeDataset = [
            'data' => $income_data,
            'label' => 'Ingresos',
            'backgroundColor' => 'rgba(0, 174, 255, 0.8)'
        ];

        $expensesDataset = [
            'data' => $expenses_data,
            'label' => 'Gastos',
            'backgroundColor' => 'rgba(255, 46, 23, 0.6)'
        ];

        $datasets = [
            $incomeDataset,
            $expensesDataset
        ];

        return new DataGenericChart($labels, $datasets);
    }
}
