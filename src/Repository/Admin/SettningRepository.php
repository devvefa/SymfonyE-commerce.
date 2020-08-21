<?php

namespace App\Repository\Admin;

use App\Entity\Admin\Settning;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Settning|null find($id, $lockMode = null, $lockVersion = null)
 * @method Settning|null findOneBy(array $criteria, array $orderBy = null)
 * @method Settning[]    findAll()
 * @method Settning[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SettningRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Settning::class);
    }

    // /**
    //  * @return Settning[] Returns an array of Settning objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Settning
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
