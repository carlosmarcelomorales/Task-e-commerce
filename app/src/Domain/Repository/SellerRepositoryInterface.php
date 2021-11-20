<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Seller;

interface SellerRepositoryInterface
{
    public function add(Seller $seller) : void;
}
