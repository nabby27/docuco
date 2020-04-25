<?php

namespace Docuco\Domain\Documents\Actions;

use Docuco\Domain\Documents\Repositories\DocumentsRepository;
use Docuco\Domain\Documents\Entities\DataGenericChart;

class GetBenefitDataToGenericChartAction
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
        $data = [null, null, null, null, null, null, null, null, null, null, null, null];
        $backgroundColors = ['', '', '', '', '', '', '', '', '', '', '', ''];

        foreach ($documents->all() as $document) {
            $year = date("Y", strtotime($document->date_of_issue));
            $month = date("n", strtotime($document->date_of_issue));
            if (date("Y") === $year) {
                if ($document->type === 'INCOME') {
                    $data[$month - 1] += $document->price;
                }
                if ($document->type === 'EXPENSE') {
                    $data[$month - 1] -= $document->price;
                }
                $backgroundColors = $this->setBackgroundColorForMonth($backgroundColors, $month, $data[$month - 1]);
            }
        }

        $dataset = [
            'data' => $data,
            'label' => 'Beneficio',
            'backgroundColor' => $backgroundColors
        ];

        $datasets = [
            $dataset,
        ];

        return new DataGenericChart($labels, $datasets);
    }
    
    private function setBackgroundColorForMonth(array $backgroundColors, int $month, int $valueForMonth) {
        if ($valueForMonth < 0) {
            $backgroundColors[$month - 1] = 'rgba(255, 46, 23, 0.6)';
        } else {
            $backgroundColors[$month - 1] = 'rgba(0, 174, 255, 0.8)';
        }

        return $backgroundColors;
    }

}

