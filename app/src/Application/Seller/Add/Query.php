<?php
declare(strict_types=1);

namespace App\Application\Seller\Add;

use App\Application\Shared\AbstractQuery;
use App\Domain\Shared\Exception\InvalidValueException;

final class Query extends AbstractQuery
{
    public function getName(): string
    {
        return $this->getData()->name;
    }

    public function assertMandatoryAttributes()
    {
        if (empty($this->getData()->name) || !is_string($this->getData()->name)) {
            throw new InvalidValueException('name', 'Incorrect value');
        }
    }
}
