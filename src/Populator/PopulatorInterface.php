<?php

namespace App\Populator;

interface PopulatorInterface
{
    public function populate(array $data): array;
}