<?php

namespace App\Application\User\Add;

use App\Domain\Shared\Exception\InvalidValueException;
use App\Application\Shared\AbstractQuery;

class Query extends AbstractQuery
{

    public function getName() : string
    {
        return $this->getData()->name;
    }

    public function assertMandatoryAttributes()
    {
        if (empty($this->getData()->name)) {
            throw new InvalidValueException('name', 'Incorrect value for name');
        }

    }
}
