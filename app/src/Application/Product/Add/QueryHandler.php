<?php

namespace App\Application\Product\Add;

use App\Domain\Entity\Product;
use App\Domain\Repository\ProductRepositoryInterface;
use App\Domain\Repository\SellerRepositoryInterface;
use App\Domain\Shared\Exception\InvalidValueException;
use Doctrine\ORM\EntityNotFoundException;

class QueryHandler
{

    /** @var ProductRepositoryInterface  */
    private $productRepositoryInterface;

    /** @var SellerRepositoryInterface */
    private $sellerRepositoryInterface;

    public function __construct(
        ProductRepositoryInterface $productRepositoryInterface,
        SellerRepositoryInterface $sellerRepositoryInterface
    )
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
        $this->sellerRepositoryInterface = $sellerRepositoryInterface;
    }

    /**
     * @param Query $query
     * @throws InvalidValueException
     * @throws EntityNotFoundException
     */
    public function __invoke(Query $query)
    {
        $this->validateLogic($query);

        $seller = $this->sellerRepositoryInterface->findById($query->getSellerId());

        $product = new Product(
            $query->getName(),
            $query->getPrice(),
            $seller,
            $query->getAmount()
        );

        $this->productRepositoryInterface->add($product);
    }

    /**
     * @param Query $query
     * @throws InvalidValueException
     */
    public function validateLogic(Query $query)
    {
        if (empty($query->getName())) {
            throw new InvalidValueException('name', 'The name cant be empty!');
        }

        if ($query->getSellerId() <= 0) {
            throw new InvalidValueException('id', 'The id cant be lower or equal than 0!');
        }

        if (empty($query->getPrice())) {
            throw new InvalidValueException('price', 'The price cant be empty!');
        }

        if (empty($query->getAmount()) || $query->getAmount() <= 0) {
            throw new InvalidValueException('amount', 'The amount cant be lower or equal than 0!');
        }
    }
}
