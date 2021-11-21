<?php

namespace App\Application\Product\Add;

use App\Application\Shared\AbstractQuery;
use App\Domain\Shared\Exception\InvalidValueException;

class Query extends AbstractQuery
{

    public function getName() : string
    {
        return $this->getData()->name;
    }

    public function getSellerId() : int
    {
        return $this->getData()->sellerId;
    }

    public function getPrice() : string
    {
        return $this->getData()->price;
    }

    public function assertMandatoryAttributes()
    {
        if (empty($this->getData()->name)) {
            throw new InvalidValueException('name', 'Incorrect value for name');
        }

        if (empty($this->getData()->sellerId)) {
            throw new InvalidValueException('id', 'Incorrect value for id');
        }

        if (empty($this->getData()->price) || !is_numeric($this->getData()->price)) {
            throw new InvalidValueException('price', 'Incorrect value for price');
        }
    }
}
