<?php

namespace App\Repository;

use App\Entity\Plat;
use App\Entity\PlatSearch;
use App\Form\PlatSearchType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Plat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Plat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Plat[]    findAll()
 * @method Plat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Plat::class);
    }
    
    /**
     * @return Plat[]
     */
    public function findAllVisible(): array
    {
        return $this->findVisibleQuery()
        ->getQuery()
        ->getResult();
    }

    /**
     * @return Plat[]
     */
    public function findAllEntreeVisible($date,PlatSearch $search): array
    {
        
        $query = $this->findVisibleTypeQuery(0,$date);

        if($search->getMaxPrice()){
            $query = $query
            ->andwhere('p.prix < :maxprice')
            ->setParameter('maxprice',$search->getMaxPrice());
        }
        return $query
        ->getQuery()
        ->getResult();
    }

    /**
     * @return Plat[]
     */
    public function findAllPlatVisible($date,PlatSearch $search): array
    {
        $query = $this->findVisibleTypeQuery(1,$date);

        
        if($search->getMaxPrice()){
            $query = $query
            ->andwhere('p.prix < :maxprice')
            ->setParameter('maxprice',$search->getMaxPrice());
        }
        if($search->getIngrediants()->count() > 0){
            $k = 0;
            foreach($search->getIngrediants() as $ingrediant){
                $k++;
                $query = $query
                ->andWhere(":ingrediant$k MEMBER OF p.ingrediants")
                ->setParameter("ingrediant$k",$ingrediant);
            }
        }
        return $query
        ->getQuery()
        ->getResult();
    }

    /**
     * @return Plat[]
     */
    public function findAllDessertVisible($date): array
    {
        return $this->findVisibleTypeQuery(2,$date)
        ->getQuery()
        ->getResult();
    }

    /**
     * @return Plat[]
     */
    public function findAllLatest(PlatSearch $search): array
    {
        return $this->findVisibleQuery()
        ->setMaxResult(7)
        ->getQuery()
        ->getResult();
    }

    public function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p');
    }

    public function findVisibleTypeQuery(int $type, $date){
        return $this->createQueryBuilder('p')
        ->setParameter('type', $type)
        ->setParameter('date', $date)
        ->where('p.type = :type')
        ->andWhere('p.date_fin > :date ');
    }

    // /**
    //  * @return Plat[] Returns an array of Plat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Plat
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
