<?php

namespace App\Repository;

use App\Entity\Orderses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Orderses|null find($id, $lockMode = null, $lockVersion = null)
 * @method Orderses|null findOneBy(array $criteria, array $orderBy = null)
 * @method Orderses[]    findAll()
 * @method Orderses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdersesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Orderses::class);
    }

    // /**
    //  * @return Orderses[] Returns an array of Orderses objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Orderses
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
