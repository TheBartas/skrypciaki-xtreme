<?php

namespace App\Repository;

use App\Entity\Streaming;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Streaming>
 */
class StreamingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Streaming::class);
    }

    public function findWithItemCount(): array {
        return $this->createQueryBuilder('c')
            ->select('c.id AS streaming_ID, c.platformName AS platform_name, COUNT(i.id) AS item_count')
            ->leftJoin('c.items', 'i')
            ->groupBy('c.id, c.platformName')
            ->orderBy('c.platformName', 'ASC')
            ->getQuery()
            ->getArrayResult();
    }

    //    /**
    //     * @return Streaming[] Returns an array of Streaming objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Streaming
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
