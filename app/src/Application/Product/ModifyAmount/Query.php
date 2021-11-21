<?php

namespace App\Application\Product\ModifyAmount;

use App\Application\Shared\AbstractQuery;
use App\Domain\Shared\Exception\InvalidValueException;

class Query extends AbstractQuery
{
    public function getProductId() : int
    {
        return $this->getData()->productId;
    }

    public function getIsIncreasing() : bool
    {
        return $this->getData()->increase;
    }

    public function getUnits() : int
    {
        return $this->getData()->units;
    }

    public function assertMandatoryAttributes()
    {
        if (empty($this->getData()->productId) || !is_int($this->getData()->productId)) {
            throw new InvalidValueException('productId', 'Incorrect value productId');
        }

        if (!is_bool($this->getData()->increase)) {
            throw new InvalidValueException('increase', 'Incorrect value increase');
        }

        if (empty($this->getData()->units) || !is_int($this->getData()->units)) {
            throw new InvalidValueException('units', 'Incorrect value units');
        }

    }
}
