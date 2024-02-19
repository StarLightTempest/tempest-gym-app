<?php

namespace App\Repository;

use App\Entity\TrainingExecution;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TrainingExecution>
 *
 * @method TrainingExecution|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrainingExecution|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrainingExecution[]    findAll()
 * @method TrainingExecution[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrainingExecutionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrainingExecution::class);
    }

//    /**
//     * @return TrainingExecution[] Returns an array of TrainingExecution objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TrainingExecution
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
