<?php

namespace Docuco\Domain\Documents\Actions;

use Docuco\Domain\Documents\Repositories\DocumentsRepository;
use Docuco\Domain\Documents\Entities\DocumentDataBarChart;

class GetDocumentsDataBarChartAction
{
  private $documents_repository;

  public function __construct(DocumentsRepository $documents_repository)
  {
    $this->documents_repository = $documents_repository;
  }

  public function execute(int $user_group_id): DocumentDataBarChart
  {
    $documents = $this->documents_repository->get_all_documents_by_user_group_id($user_group_id);
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

    return new DocumentDataBarChart($labels, $income_data, $expenses_data);
  }
}
