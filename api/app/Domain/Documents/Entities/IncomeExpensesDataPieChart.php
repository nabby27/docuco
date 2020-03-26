<?php

namespace Docuco\Domain\Documents\Entities;

class IncomeExpensesDataPieChart
{
    public $labels;
    public $data;

    public function __construct(
        array $labels,
        array $data
    ) {
        $this->labels = $labels;
        $this->data = $data;
    }
}
