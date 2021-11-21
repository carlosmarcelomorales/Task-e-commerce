<?php

namespace App\Application\Cart\Delete;

use App\Domain\Repository\CartRepositoryInterface;
use App\Domain\Repository\ProductRepositoryInterface;
use App\Domain\Shared\Exception\InvalidValueException;
use Doctrine\ORM\EntityNotFoundException;

class QueryHandler
{
    /** @var ProductRepositoryInterface */
    private $productRepositoryInterface;

    /** @var CartRepositoryInterface */
    private $cartRepositoryInterface;

    public function __construct(
        ProductRepositoryInterface $productRepositoryInterface,
        CartRepositoryInterface $cartRepositoryInterface
    )
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
        $this->cartRepositoryInterface = $cartRepositoryInterface;
    }

    /**
     * @param Query $query
     * @throws InvalidValueException
     */
    public function __invoke(Query $query)
    {
        $this->validateLogic($query);

        try {
            $cart = $this->cartRepositoryInterface->findByIdUser($query->getUserId());
        } catch (EntityNotFoundException $e) {
            throw new EntityNotFoundException();
        }

        $product = $this->productRepositoryInterface->findById($query->getProductId());

        $cart->removeProduct($product);

        $this->cartRepositoryInterface->update($cart);

    }

    /**
     * @param Query $query
     * @throws InvalidValueException
     */
    public function validateLogic(Query $query)
    {
        if (empty($query->getUserId()) || $query->getUserId() <= 0) {
            throw new InvalidValueException('userId', 'Invalid value for userId');
        }

        if (empty($query->getProductId()) || $query->getProductId() <= 0) {
            throw new InvalidValueException('productId', 'Invalid value for productId');
        }

    }
}
