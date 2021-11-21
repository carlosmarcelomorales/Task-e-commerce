<?php

namespace App\Application\Product\ModifyAmount;

class Response
{
    /** @var int $amount */
    private $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}
