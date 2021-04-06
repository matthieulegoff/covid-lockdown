<?php

namespace App\Model;

class Test
{
    /** @var DateTime */
    private $date;

    /** @var int */
    private $positive;

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
    public function setDate(\DateTime $date): Test
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return int
     */
    public function getPositive(): int
    {
        return $this->positive;
    }

    /**
     * @param int $positive
     * @return Hospital
     */
    public function setPositive(int $positive): Test
    {
        $this->positive = $positive;

        return $this;
    }


}
