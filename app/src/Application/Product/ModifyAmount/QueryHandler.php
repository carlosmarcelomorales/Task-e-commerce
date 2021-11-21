<?php

namespace App\Application\Product\ModifyAmount;

use App\Domain\Repository\ProductRepositoryInterface;
use App\Domain\Shared\Exception\InvalidValueException;

class QueryHandler
{

    /** @var ProductRepositoryInterface */
    private $productRepositoryInterface;

    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    /**
     * @param Query $query
     * @throws InvalidValueException
     */
    public function __invoke(Query $query) : Response
    {
        $this->validateLogic($query);

        $product = $this->productRepositoryInterface->findById($query->getProductId());

        if ($query->getIsIncreasing()) {
            $amount = $product->getAmount() + $query->getUnits();
            $product->setAmount($amount);
            $product->setValid(1);
        } else {
            $amount = $product->getAmount() - $query->getUnits();

            $product->setAmount($amount);
            if ($product->getAmount() <= 0) {
                $product->setAmount(0);
                $product->setValid(0);
            }
        }

        $this->productRepositoryInterface->update($product);

        return new Response($amount);
    }

    /**
     * @param Query $query
     * @throws InvalidValueException
     */
    public function validateLogic(Query $query)
    {
        if ($query->getProductId() <= 0) {
            throw new InvalidValueException('productId', 'The productId cant be lower or equal than 0!');
        }

        if (empty($query->getUnits()) || $query->getUnits() <= 0) {
            throw new InvalidValueException('units', 'The units cant be lower or equal than 0!');
        }
    }
}
