<?php

namespace App\Application\Cart\GetAmount;

class Response
{
    /** @var int $price */
    private $price;

    public function getPrice(): int
    {
        return $this->price;
    }

    public function __construct(int $price)
    {
        $this->price = $price;
    }

}
