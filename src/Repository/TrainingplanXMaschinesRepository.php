<?php

namespace App\Repository;

use App\Entity\TrainingplanXMaschines;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TrainingplanXMaschines>
 *
 * @method TrainingplanXMaschines|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrainingplanXMaschines|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrainingplanXMaschines[]    findAll()
 * @method TrainingplanXMaschines[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrainingplanXMaschinesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrainingplanXMaschines::class);
    }

//    /**
//     * @return TrainingplanXMaschines[] Returns an array of TrainingplanXMaschines objects
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

//    public function findOneBySomeField($value): ?TrainingplanXMaschines
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
