<?php

namespace App\Service;

class AnalyticsService
{
    const MESSAGES_BAD   = [
        "Non.",
        "On va pas se mentir, c'est chaud là.",
        "Les bars sont pas prêts d'ouvrir.",
        "Ouais en 2022 peut-etre.",
        "Absolument pas du tout.",
    ];
    const MESSAGES_GOOD  = [
        "On dirait bien qu'on est sur la bonne voie.",
        "C'est pas demain, mais presque.",
        "Bientôt la fin, on lâche rien.",
        "On est pas mal là, encore quelques jours.",
        "Ca sent bon l'ouverture des bars là.",
    ];

    /**
     * @param array $hospitalData
     * @param array $testsData
     * @return string
     */
    public function getResult(array $hospitalData, array $testsData): string
    {
        $hospitalTrend = $this->calculateTrend(
            array_splice($hospitalData, -7),
            array_splice($hospitalData, -14, 7)
        );

        $testsTrend = $this->calculateTrend(
            array_splice($testsData, -7),
            array_splice($testsData, -14, 7)
        );

        if ($hospitalTrend && $testsTrend) {
            return self::MESSAGES_GOOD[rand(0, count(self::MESSAGES_GOOD) - 1)];
        }

        return self::MESSAGES_BAD[rand(0, count(self::MESSAGES_BAD) - 1)];
    }

    /**
     * TODO: This is a very simple trend calculation method. Try to use linear regression here
     * https://en.wikipedia.org/wiki/Simple_linear_regression
     *
     * @param array $currentValues
     * @param array $previousValues
     * @return int
     */
    public function calculateTrend(array $currentValues, array $previousValues): int
    {
        $currentAverage  = $this->calculateAverage($currentValues);
        $previousAverage = $this->calculateAverage($previousValues);

        if ($previousAverage < $currentAverage) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * @param array $values
     * @return float
     */
    public function calculateAverage(array $values): float
    {
        $array = array_filter($values);
        return array_sum($array) / count($array);
    }
}
