<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Seller;
use App\Domain\Repository\SellerRepositoryInterface;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

class SellerRepository implements SellerRepositoryInterface
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(Seller $seller): void
    {
        try {
            $this->entityManager->persist($seller);
            $this->entityManager->flush();
        } catch (Exception $e)
        {
            throw new EntityNotFoundException();
        }
    }

}
