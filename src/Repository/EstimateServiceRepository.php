<?php

namespace App\Repository;

use App\Entity\EstimateService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EstimateService|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstimateService|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstimateService[]    findAll()
 * @method EstimateService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstimateServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstimateService::class);
    }

    // /**
    //  * @return EstimateService[] Returns an array of EstimateService objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EstimateService
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
