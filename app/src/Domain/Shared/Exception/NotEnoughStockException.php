<?php


namespace App\Domain\Shared\Exception;


class NotEnoughStockException extends \Exception
{

    public function __construct(string $message = null)
    {
        parent::__construct($message);
    }
}
