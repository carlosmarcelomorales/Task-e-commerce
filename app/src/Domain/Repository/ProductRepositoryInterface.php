<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Product;

interface ProductRepositoryInterface
{
    public function add(Product $product) : void;

    public function findById(int $id) : Product;

    public function update(Product $product): void;
}
