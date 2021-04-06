<?php

namespace App\Model;

class Hospital
{
    /** @var DateTime */
    private $date;

    /** @var int People currently in intensive care units */
    private $intensiveCare;

    /**
     * @return DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     * @return Hospital
     */
    public function setDate(\DateTime $date): Hospital
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return int
     */
    public function getIntensiveCare(): int
    {
        return $this->intensiveCare;
    }

    /**
     * @param int $intensiveCare
     * @return Hospital
     */
    public function setIntensiveCare(int $intensiveCare): Hospital
    {
        $this->intensiveCare = $intensiveCare;

        return $this;
    }


}
