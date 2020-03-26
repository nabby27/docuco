<?php

namespace Docuco\Domain\Documents\Entities;

class DocumentDataBarChart
{
    public $labels;
    public $income;
    public $expenses;

    public function __construct(
        array $labels,
        array $income,
        array $expenses
    ) {
        $this->labels = $labels;
        $this->income = $income;
        $this->expenses = $expenses;
    }
}
