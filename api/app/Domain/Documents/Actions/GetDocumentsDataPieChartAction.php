<?php

namespace Docuco\Domain\Documents\Actions;

use Docuco\Domain\Documents\Repositories\DocumentsRepository;
use Docuco\Domain\Documents\Entities\DocumentDataPieChart;

class GetDocumentsDataPieChartAction
{
  private $documents_repository;

  public function __construct(DocumentsRepository $documents_repository)
  {
    $this->documents_repository = $documents_repository;
  }

  public function execute(int $user_group_id): DocumentDataPieChart
  {
    $documents = $this->documents_repository->get_all_documents_by_user_group_id($user_group_id);
    $labels = ['Ingresos', 'Gastos'];
    $data = [0, 0];

    foreach ($documents->all() as $document) {
      if ($document->type === 'INCOME') {
        $data[0] += $document->price;
      }
      if ($document->type === 'EXPENSE') {
        $data[1] += $document->price;
      }
    }

    return new DocumentDataPieChart($labels, $data);
  }
}
