<?php

namespace App\Application\Cart\GetAmount;

use App\Application\Shared\AbstractQuery;
use App\Domain\Shared\Exception\InvalidValueException;

class Query extends AbstractQuery
{

    public function getUserId() : int
    {
        return $this->getData()->userId;
    }

    public function assertMandatoryAttributes()
    {
        if (empty($this->getData()->userId) || !is_int($this->getData()->userId)) {
            throw new InvalidValueException('userId', 'Incorrect value userId');
        }
    }
}
