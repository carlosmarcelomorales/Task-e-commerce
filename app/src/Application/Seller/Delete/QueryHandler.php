<?php

namespace App\Application\Seller\Delete;

use App\Domain\Repository\SellerRepositoryInterface;
use App\Domain\Shared\Exception\InvalidValueException;
use Doctrine\ORM\EntityNotFoundException;

class QueryHandler
{
    /** @var $sellerRepository */
    private $sellerRepository;

    public function __construct(SellerRepositoryInterface $sellerRepository)
    {
        $this->sellerRepository = $sellerRepository;
    }

    /**
     * @param Query $query
     * @throws InvalidValueException
     * @throws EntityNotFoundException
     */
    public function __invoke(Query $query)
    {
        $this->validateLogic($query);

        $seller = $this->sellerRepository->findById($query->getId());

        $seller->setValid(0);

        $this->sellerRepository->update($seller);
    }

    public function validateLogic(Query $query)
    {
        if (empty($query->getId()) || $query->getId() <= 0) {
            throw new InvalidValueException('id', 'Invalid value for id');
        }
    }

}
