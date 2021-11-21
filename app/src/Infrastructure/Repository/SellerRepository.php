<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Seller;
use App\Domain\Repository\SellerRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Seller|null find($id, $lockMode = null, $lockVersion = null)
 * @method Seller|null findOneBy(array $criteria, array $orderBy = null)
 * @method Seller[]    findAll()
 * @method Seller[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SellerRepository extends ServiceEntityRepository implements SellerRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Seller::class);
    }

    public function add(Seller $seller): void
    {
        $this->getEntityManager()->persist($seller);
        $this->getEntityManager()->flush();
    }

    public function findById(int $id): Seller
    {
        $seller = $this->find($id);

        if (is_null($seller)){
            throw new EntityNotFoundException();
        }

        return $seller;

    }

    public function update(Seller $seller): void
    {
        $this->getEntityManager()->flush();
    }
}
