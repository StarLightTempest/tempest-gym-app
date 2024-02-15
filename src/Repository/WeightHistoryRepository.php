<?php

namespace App\Repository;

use App\Entity\WeightHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WeightHistory>
 *
 * @method WeightHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeightHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeightHistory[]    findAll()
 * @method WeightHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeightHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeightHistory::class);
    }

//    /**
//     * @return WeightHistory[] Returns an array of WeightHistory objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?WeightHistory
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
