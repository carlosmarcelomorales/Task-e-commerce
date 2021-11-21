<?php

namespace App\Application\Product\Delete;

use App\Domain\Repository\ProductRepositoryInterface;
use App\Domain\Shared\Exception\InvalidValueException;

class QueryHandler
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepositoryInterface;

    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    /**
     * @param Query $query
     * @throws InvalidValueException
     */
    public function __invoke(Query $query)
    {
        $this->validateLogic($query);

        $product = $this->productRepositoryInterface->findById($query->getId());
        $product->setValid(0);

        $this->productRepositoryInterface->update($product);
    }

    /**
     * @param Query $query
     * @throws InvalidValueException
     */
    public function validateLogic(Query $query)
    {
        if (empty($query->getId()) || $query->getId() <= 0) {
            throw new InvalidValueException('id', 'Invalid value for id');
        }
    }
}
