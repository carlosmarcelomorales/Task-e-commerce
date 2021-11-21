<?php

namespace App\Application\Cart\Add;

use App\Application\Shared\AbstractQuery;
use App\Domain\Shared\Exception\InvalidValueException;

class Query extends AbstractQuery
{

    public function getUserId() : int
    {
        return $this->getData()->userId;
    }

    public function getProductId() : int
    {
        return $this->getData()->productId;
    }

    public function getAmount() : int
    {
        return $this->getData()->amount;
    }

    public function assertMandatoryAttributes()
    {
        if (empty($this->getData()->userId) || !is_int($this->getData()->userId)) {
            throw new InvalidValueException('userId', 'Incorrect value userId');
        }

        if (empty($this->getData()->productId) || !is_int($this->getData()->productId)) {
            throw new InvalidValueException('productId', 'Incorrect value productId');
        }

        if (empty($this->getData()->amount) || !is_int($this->getData()->amount)) {
            throw new InvalidValueException('amount', 'Incorrect value amount');
        }
    }
}
