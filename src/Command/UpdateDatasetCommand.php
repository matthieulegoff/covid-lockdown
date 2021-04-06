<?php

namespace App\Command;

use App\Service\DatasetService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateDatasetCommand extends Command
{
    protected static $defaultName = 'app:update-dataset';

    protected $datasetService;

    public function __construct(DatasetService $datasetService, string $name = null)
    {
        $this->datasetService = $datasetService;

        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription('Update dataset indicators.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->datasetService->retrieveIndicators();

        return Command::SUCCESS;
    }
}
