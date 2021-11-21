<?php

namespace App\Application\Seller\Delete;

use App\Application\Shared\AbstractQuery;
use App\Domain\Shared\Exception\InvalidValueException;

class Query extends AbstractQuery
{

    public function getId() : int
    {
        return $this->getData()->id;
    }

    public function assertMandatoryAttributes()
    {
        if (empty($this->getData()->id) || !is_int($this->getData()->id)) {
            throw new InvalidValueException('id', 'Incorrect value Id');
        }
    }
}
