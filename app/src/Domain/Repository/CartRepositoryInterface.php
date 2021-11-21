<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Cart;

interface CartRepositoryInterface
{
    public function add(Cart $cart) : void;

    public function update(Cart $cart): void;

    public function findByIdUser(int $userId) : ?Cart;
}
