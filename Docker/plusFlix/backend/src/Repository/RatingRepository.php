<?php

namespace App\Repository;

use App\Entity\Rating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rating>
 */
class RatingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rating::class);
    }

    public function findWithItem() : array {
        return $this->createQueryBuilder('r') 
            ->select("
                r.id AS rat_ID,
                r.comment,
                r.rating,
                i.id AS item_ID,
                i.name
            ")
            ->leftJoin('r.items', 'i')
            ->getQuery()
            ->getArrayResult();
    }

    public function searchByItemTitle(?string $name): array
    {
        $query = $this->createQueryBuilder('r')
            ->select("
                r.id AS rat_ID,
                r.comment,
                r.rating,
                i.id AS item_ID,
                i.name
            ")
            ->leftJoin('r.items', 'i');

        if ($name) {
            $query->andWhere('i.name LIKE :query')
            ->setParameter('query', '%' . $name . '%');
        }

        return $query->getQuery()->getArrayResult();
    }

    //    /**
    //     * @return Rating[] Returns an array of Rating objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Rating
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
