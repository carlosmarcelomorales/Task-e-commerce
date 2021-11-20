<?php

namespace App\Application\Shared;

use App\Domain\Shared\Exception\InvalidValueException;

interface QueryInterface
{
    public function getData(): \stdClass;

    /**
     * @throws InvalidValueException
     */
    public function assertMandatoryAttributes();

}
