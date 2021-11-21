<?php

namespace App\Application\Cart\GetAmount;

use App\Domain\Repository\CartRepositoryInterface;
use App\Domain\Shared\Exception\InvalidValueException;

class QueryHandler
{

    /** @var CartRepositoryInterface */
    private $cartRepositoryInterface;

    public function __construct(CartRepositoryInterface $cartRepositoryInterface)
    {
        $this->cartRepositoryInterface = $cartRepositoryInterface;
    }

    /**
     * @param Query $query
     * @throws InvalidValueException
     */
    public function __invoke(Query $query)
    {
        $this->validateLogic($query);

        $cart = $this->cartRepositoryInterface->findByIdUser($query->getUserId());

        $price = 0;

        foreach ($cart->getCartProduct() as $item) {
            $price += $item->getProduct()->getPrice();
        }

        return new Response((int)$price);
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

    }
}
