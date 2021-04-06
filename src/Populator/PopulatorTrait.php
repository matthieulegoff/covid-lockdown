<?php


namespace App\Populator;


trait PopulatorTrait
{
    public function normalizeCell(string $cell): string
    {
        $normalized = str_replace(['"', "'", 'NA', 'N.A', 'N.A.', "\n"], '', $cell);

        return $normalized;
    }
}
