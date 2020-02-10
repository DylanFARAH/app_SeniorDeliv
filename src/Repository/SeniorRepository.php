<?php

namespace App\Repository;

use App\Entity\Senior;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Senior|null find($id, $lockMode = null, $lockVersion = null)
 * @method Senior|null findOneBy(array $criteria, array $orderBy = null)
 * @method Senior[]    findAll()
 * @method Senior[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeniorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Senior::class);
    }

    // /**
    //  * @return Senior[] Returns an array of Senior objects
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
    public function findOneBySomeField($value): ?Senior
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
