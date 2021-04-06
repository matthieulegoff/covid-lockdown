<?php

namespace App\Controller;

use App\Model\Hospital;
use App\Service\AnalyticsService;
use App\Service\DatasetService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * TODO: Cache result
     * @Route("/", name="app_index")
     */
    public function index(AnalyticsService $analyticsService, DatasetService $datasetService, array $indicators, bool $lockedDown): Response
    {
        if (false === $lockedDown) {
            $result = "C'est fini, tu peux sortir dans un bar à plus de 10km.";
        } else {
            $result = $analyticsService->getResult(
                $datasetService->parseDataset(
                    $indicators['hospital']['filename'],
                    $indicators['hospital']['populator']
                ),
                $datasetService->parseDataset(
                    $indicators['tests']['filename'],
                    $indicators['tests']['populator']
                ));
        }

        return $this->render('default/index.html.twig', [
            'result' => $result
        ]);
    }

    /**
     * @Route("/charts", name="app_charts")
     */
    public function charts(DatasetService $datasetService, array $indicators): Response
    {
        list($hospitalDates, $hospitalValues) = $this->splitDataset(
            $datasetService->parseDataset(
                $indicators['hospital']['filename'],
                $indicators['hospital']['populator']
            ), 'intensiveCare'
        );

        list($testsDates, $testsValues) = $this->splitDataset(
            $datasetService->parseDataset(
                $indicators['tests']['filename'],
                $indicators['tests']['populator']
            ), 'positive'
        );

        return $this->render('default/charts.html.twig', [
            'hospitalDates'  => $hospitalDates,
            'hospitalValues' => $hospitalValues,
            'testsDates'     => $testsDates,
            'testsValues'    => $testsValues
        ]);
    }

    /**
     * TODO: Method not scalable, must be refactored
     *
     * @param array $dataset
     * @param $valueGetter
     * @return array
     */
    private function splitDataset(array $dataset, $valueGetter): array
    {
        $getter = 'get'.ucwords($valueGetter);

        $dates = $values = [];
        foreach ($dataset as $data) {
            $dates[]  = $data->getDate()->format('d-m-Y');
            $values[] = $data->$getter();
        }

        return [$dates, $values];
    }
}
