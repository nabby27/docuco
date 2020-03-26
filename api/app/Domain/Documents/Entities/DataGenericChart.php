<?php

namespace Docuco\Domain\Documents\Entities;

class DataGenericChart
{
    public $labels;
    public $datasets;

    public function __construct(
        array $labels,
        array $datasets
    ) {
        $this->labels = $labels;
        $this->datasets = $datasets;
    }
}
