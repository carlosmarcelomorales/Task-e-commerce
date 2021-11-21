<?php

namespace App\Application\Cart\Add;

use App\Domain\Entity\Cart;
use App\Domain\Repository\CartRepositoryInterface;
use App\Domain\Repository\ProductRepositoryInterface;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\Shared\Exception\InvalidValueException;
use Doctrine\ORM\EntityNotFoundException;

class QueryHandler
{
    /** @var ProductRepositoryInterface */
    private $productRepositoryInterface;

    /** @var UserRepositoryInterface */
    private $userRepositoryInterface;

    /** @var CartRepositoryInterface */
    private $cartRepositoryInterface;

    public function __construct(
        ProductRepositoryInterface $productRepositoryInterface,
        UserRepositoryInterface $userRepositoryInterface,
        CartRepositoryInterface $cartRepositoryInterface
    )
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
        $this->userRepositoryInterface = $userRepositoryInterface;
        $this->cartRepositoryInterface = $cartRepositoryInterface;
    }

    /**
     * @param Query $query
     * @throws InvalidValueException
     * @throws EntityNotFoundException
     */
    public function __invoke(Query $query)
    {
        $this->validateLogic($query);

        $user = $this->userRepositoryInterface->findById($query->getUserId());

        try{
            $cart = $this->cartRepositoryInterface->findByIdUser($query->getUserId());
        } catch (EntityNotFoundException $e) {
            $cart = new Cart($user);
        }

        $this->cartRepositoryInterface->add($cart);
        $product = $this->productRepositoryInterface->findById($query->getProductId());

        $cart->addProduct($product);

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
