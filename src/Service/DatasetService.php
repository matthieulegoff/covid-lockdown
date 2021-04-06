<?php

namespace App\Service;

use App\Populator\PopulatorInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class DatasetService
{
    const DATASET_PATH = 'var/dataset';

    protected $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public function retrieveDataset(string $url, string $filename): void
    {
        $content = @file_get_contents($url);

        if (false === $content) {
            throw new \RuntimeException(sprintf('Unable to retrieve dataset from %s', $url));
        }

        $dataset = sprintf('%s/%s/%s', $this->parameterBag->get('kernel.project_dir'), self::DATASET_PATH, $filename);

        if (false === file_put_contents($dataset, $content)) {
            throw new \RuntimeException(sprintf('Unable to write "%s" dataset', $dataset));
        }
    }

    public function retrieveIndicators(): void
    {
        $indicators = $this->parameterBag->get('indicators');

        foreach ($indicators as $indicator) {
            $this->retrieveDataset($indicator['url'], $indicator['filename']);
        }
    }

    public function parseDataset(string $filename, string $populator, $removeFirstLine = true): array
    {
        $dataset = sprintf('%s/%s/%s', $this->parameterBag->get('kernel.project_dir'), self::DATASET_PATH, $filename);
        $content = @file($dataset);

        if (false === $content) {
            throw new \RuntimeException(sprintf('Unable to read "%s" dataset', $dataset));
        }

        if ($removeFirstLine) {
            array_shift($content);
        }

        /** @var $popObject PopulatorInterface */
        $popObject = new $populator;

        return $popObject->populate($content);
    }
}
