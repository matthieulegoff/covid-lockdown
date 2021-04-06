<?php

namespace App\Populator;

use App\Model\Hospital;

class HospitalPopulator implements PopulatorInterface
{
    use PopulatorTrait;

    const DATASET_DELIMITER = ';';

    public function populate(array $data): array
    {
        $collection = [];
        $currentDate = new \DateTime();
        $intensiveCareCounter = 0;

        foreach ($data as $row) {
            $cells = explode(self::DATASET_DELIMITER, $row);

            // Skip gendered data rows
            if ((int) $this->normalizeCell($cells[1]) > 0) {
                continue;
            }

            $date = new \DateTime($this->normalizeCell($cells[2]));

            if ($date == $currentDate) {
                $intensiveCareCounter += (int) $this->normalizeCell($cells[4]);
            } else {
                $hospital = new Hospital();
                $hospital->setDate($date);
                $hospital->setIntensiveCare($intensiveCareCounter);

                $collection[] = $hospital;

                $currentDate = $date;
                $intensiveCareCounter = 0;
            }
        }

        return $collection;
    }
}
