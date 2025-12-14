<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findWithItemCount(): array {
        return $this->createQueryBuilder('c')
            ->select('c.id AS cat_ID, c.genre, COUNT(i.id) AS item_count')
            ->leftJoin('c.items', 'i')
            ->groupBy('c.id, c.genre')
            ->orderBy('c.genre', 'ASC')
            ->getQuery()
            ->getArrayResult();
    }

    public function searchByGenre(?string $genre): array
    {
        $query = $this->createQueryBuilder('c')
            ->select('c.id AS cat_ID, c.genre, COUNT(i.id) AS item_count')
            ->leftJoin('c.items', 'i');

        if ($genre) {
            $query->andWhere('c.genre LIKE :query')
            ->setParameter('query', '%' . $genre . '%');
        }

        $query->groupBy('c.id, c.genre')->orderBy('c.genre', 'ASC');

        return $query->getQuery()->getArrayResult();
    }

    //    /**
    //     * @return Category[] Returns an array of Category objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Category
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
