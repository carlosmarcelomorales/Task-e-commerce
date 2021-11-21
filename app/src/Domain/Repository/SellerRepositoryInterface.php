<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Seller;

interface SellerRepositoryInterface
{
    public function add(Seller $seller) : void;

    public function findById(int $id) : Seller;

    public function update(Seller $seller): void;
}
