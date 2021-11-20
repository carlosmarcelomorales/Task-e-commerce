<?php

namespace App\Domain\Shared\Exception;

class InvalidValueException extends \Exception
{
    private $property;

    public function __construct(string $property, string $message = null)
    {
        $this->property = $property;

        parent::__construct($message);
    }

    public function getProperty(): string
    {
        return $this->property;
    }
}
