<?php

namespace App\Application\Cart\Confirm;

use App\Domain\Entity\Order;
use App\Domain\Repository\CartRepositoryInterface;
use App\Domain\Repository\OrderRepositoryInterface;
use App\Domain\Repository\ProductRepositoryInterface;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\Shared\Exception\InvalidValueException;

class QueryHandler
{

    /** @var OrderRepositoryInterface */
    private $orderRepositoryInterface;

    /** @var UserRepositoryInterface */
    private $userRepositoryInterface;

    /** @var CartRepositoryInterface */
    private $cartRepositoryInterface;

    public function __construct(
        CartRepositoryInterface $cartRepositoryInterface,
        OrderRepositoryInterface $orderRepositoryInterface
    )
    {
        $this->orderRepositoryInterface = $orderRepositoryInterface;
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

        $order = new Order($query->getPrice(), $cart);

        $this->orderRepositoryInterface->add($order);

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
