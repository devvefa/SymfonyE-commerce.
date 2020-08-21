<?php

namespace App\Repository\Admin;

use App\Entity\Admin\slids;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method slids|null find($id, $lockMode = null, $lockVersion = null)
 * @method slids|null findOneBy(array $criteria, array $orderBy = null)
 * @method slids[]    findAll()
 * @method slids[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class slidsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, slids::class);
    }

    // /**
    //  * @return slids[] Returns an array of slids objects
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
    public function findOneBySomeField($value): ?slids
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
