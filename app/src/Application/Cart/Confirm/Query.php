<?php

namespace App\Application\Cart\Confirm;

use App\Application\Shared\AbstractQuery;
use App\Domain\Shared\Exception\InvalidValueException;

class Query extends AbstractQuery
{

    public function getUserId() : int
    {
        return $this->getData()->userId;
    }

    public function getPrice() : int
    {
        return $this->getData()->price;
    }

    public function assertMandatoryAttributes()
    {
        if (empty($this->getData()->userId) || !is_int($this->getData()->userId)) {
            throw new InvalidValueException('userId', 'Incorrect value userId');
        }

        if (empty($this->getData()->price) || !is_int($this->getData()->price)) {
            throw new InvalidValueException('price', 'Incorrect value price');
        }
    }

}
