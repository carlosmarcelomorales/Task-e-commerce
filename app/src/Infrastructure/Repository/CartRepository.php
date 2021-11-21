<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Cart;
use App\Domain\Repository\CartRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cart[]    findAll()
 * @method Cart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartRepository extends ServiceEntityRepository implements CartRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }

    public function add(Cart $cart): void
    {
        $this->getEntityManager()->persist($cart);
        $this->getEntityManager()->flush();
    }

    public function update(Cart $cart): void
    {
        $this->getEntityManager()->persist($cart);
        $this->getEntityManager()->flush();
    }

    public function findByIdUser(int $userId): ?Cart
    {
        $qb = $this->createQueryBuilder('c');

        $qb->select('c')
            ->where('c.user = :userId')
            ->setParameter('userId', $userId);

        $cart = $qb->getQuery()->getOneOrNullResult();

        if (is_null($cart)) {
            throw new EntityNotFoundException();
        }
        return $cart;
    }
}
