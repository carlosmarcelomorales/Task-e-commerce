<?php

namespace App\Application\Seller\Add;

use App\Domain\Entity\Seller;
use App\Domain\Repository\SellerRepositoryInterface;
use App\Domain\Shared\Exception\InvalidValueException;

class QueryHandler
{

    /** @var  $sellerRepository */
    private $sellerRepository;

    public function __construct(SellerRepositoryInterface $sellerRepository)
    {
        $this->sellerRepository = $sellerRepository;
    }

    /**
     * @param Query $query
     * @throws InvalidValueException
     */
    public function __invoke(Query $query)
    {
        $this->validateLogic($query);

        $seller = new Seller($query->getName());

        $this->sellerRepository->add($seller);
    }

    /**
     * @param Query $query
     * @throws InvalidValueException
     */
    public function validateLogic(Query $query)
    {
        if (empty($query)) {
            throw new InvalidValueException('name', 'The name cant be empty!');
        }
    }
}
