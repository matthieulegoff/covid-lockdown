<?php

namespace App\Populator;

use App\Model\Test;

class TestsPopulator implements PopulatorInterface
{
    use PopulatorTrait;

    const DATASET_DELIMITER = ';';

    public function populate(array $data): array
    {
        $collection = [];

        foreach ($data as $row) {
            $cells = explode(self::DATASET_DELIMITER, $row);

            // Skip age data rows
            if ((int) $this->normalizeCell($cells[8]) > 0) {
                continue;
            }

            $test = new Test();
            $test->setDate(new \DateTime($this->normalizeCell($cells[1])));
            $test->setPositive((int) $this->normalizeCell($cells[4]));

            $collection[] = $test;
        }

        return $collection;
    }
}
