<?php

namespace App\Repository;

use App\Entity\Kullanici;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Kullanici|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kullanici|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kullanici[]    findAll()
 * @method Kullanici[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KullaniciRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Kullanici::class);
    }

    // /**
    //  * @return Kullanici[] Returns an array of Kullanici objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Kullanici
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
