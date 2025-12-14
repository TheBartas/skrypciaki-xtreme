<?php

namespace App\Repository;

use App\Entity\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Func;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Item>
 */
class ItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);
    }

    public function findByFilters(array $filters)
    {
        $qb = $this->createQueryBuilder('i');

        // ---------------- Scalar filters ----------------
        if (!empty($filters['name'])) {
            $qb->andWhere('LOWER(i.name) LIKE LOWER(:name)')
                ->setParameter('name', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['year'])) {
            $qb->andWhere('i.year = :year')
                ->setParameter('year', $filters['year']);
        }

        if (!empty($filters['director'])) {
            $qb->andWhere('LOWER(i.director) LIKE LOWER(:director)')
                ->setParameter('director', '%' . $filters['director'] . '%');
        }

        if (!empty($filters['actors'])) {
            $qb->andWhere('LOWER(i.actors) LIKE LOWER(:actors)')
                ->setParameter('actors', '%' . $filters['actors'] . '%');
        }

        if (!empty($filters['type'])) {
            $qb->andWhere('i.type = :type') // type is integer
            ->setParameter('type', $filters['type']);
        }

        if (!empty($filters['duration'])) {
            $qb->andWhere('i.duration = :duration')
                ->setParameter('duration', $filters['duration']);
        }

        if (array_key_exists('season', $filters)) {
            if ($filters['season'] === null) {
                $qb->andWhere('i.season IS NULL');
            } else {
                $qb->andWhere('i.season = :season')
                    ->setParameter('season', $filters['season']);
            }
        }

        // ---------------- ManyToMany filters ----------------
        if (!empty($filters['categories'])) {
            $qb->leftJoin('i.categories', 'c')
                ->andWhere($qb->expr()->in('c.id', ':categories'))
                ->setParameter('categories', $filters['categories']);
        }

        if (!empty($filters['streamings'])) {
            $qb->leftJoin('i.streamings', 's')
                ->andWhere($qb->expr()->in('s.id', ':streamings'))
                ->setParameter('streamings', $filters['streamings']);
        }

        $qb->distinct(); // avoid duplicates from joins

        return $qb->getQuery()->getResult();
    }
    
    public function findByNameContains(string $name): array
    {
        return $this->createQueryBuilder('i')
            ->where('LOWER(i.name) LIKE :name')
            ->setParameter('name', '%' . strtolower($name) . '%')
            ->orderBy('i.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByIds(array $ids) : array {
        return $this->createQueryBuilder('i')
            ->andWhere('i.id IN (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult();
    }
    
    public function findAllDirectors(): array
    {
        $results = $this->createQueryBuilder('i')
            ->select('DISTINCT i.director')
            ->where('i.director IS NOT NULL')
            ->orderBy('i.director', 'ASC')
            ->getQuery()
            ->getResult();
        return array_map(fn($a) => $a['director'], $results);
    }

    public function findByFiltersSorted(array $filters, string $sort)
    {
        $qb = $this->createQueryBuilder('i');

        // ---------------- Scalar filters ----------------
        if (!empty($filters['name'])) {
            $qb->andWhere('LOWER(i.name) LIKE LOWER(:name)')
                ->setParameter('name', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['year'])) {
            $qb->andWhere('i.year = :year')
                ->setParameter('year', $filters['year']);
        }

        if (!empty($filters['director'])) {
            $qb->andWhere('LOWER(i.director) LIKE LOWER(:director)')
                ->setParameter('director', '%' . $filters['director'] . '%');
        }

        if (!empty($filters['actors'])) {
            $qb->andWhere('LOWER(i.actors) LIKE LOWER(:actors)')
                ->setParameter('actors', '%' . $filters['actors'] . '%');
        }

        if (!empty($filters['type'])) {
            $qb->andWhere('i.type = :type') // type is integer
            ->setParameter('type', $filters['type']);
        }

        if (!empty($filters['duration'])) {
            $qb->andWhere('i.duration = :duration')
                ->setParameter('duration', $filters['duration']);
        }

        if (array_key_exists('season', $filters)) {
            if ($filters['season'] === null) {
                $qb->andWhere('i.season IS NULL');
            } else {
                $qb->andWhere('i.season = :season')
                    ->setParameter('season', $filters['season']);
            }
        }

        // ---------------- ManyToMany filters ----------------
        if (!empty($filters['categories'])) {
            $qb->leftJoin('i.categories', 'c')
                ->andWhere($qb->expr()->in('c.id', ':categories'))
                ->setParameter('categories', $filters['categories']);
        }

        if (!empty($filters['streamings'])) {
            $qb->leftJoin('i.streamings', 's')
                ->andWhere($qb->expr()->in('s.id', ':streamings'))
                ->setParameter('streamings', $filters['streamings']);
        }

        if (!empty($filters['tags'])) {
            $qb->leftJoin('i.tags', 't')
            ->andWhere('t.id IN (:tags)')
            ->setParameter('tags', $filters['tags']);
        }

        if (!empty($filters['year_range'])) {
            switch ($filters['year_range']) {
                case '2020+':
                    $qb->andWhere('i.year >= 2020');
                    break;
                case '2010-2019':
                    $qb->andWhere('i.year BETWEEN 2010 AND 2019');
                    break;
                case '2000-2009':
                    $qb->andWhere('i.year BETWEEN 2000 AND 2009');
                    break;
                case '1990-1999':
                    $qb->andWhere('i.year BETWEEN 1990 AND 1999');
                    break;
                case '1980-1989':
                    $qb->andWhere('i.year BETWEEN 1980 AND 1989');
                    break;
                case '1970-1979':
                    $qb->andWhere('i.year BETWEEN 1970 AND 1979');
                    break;
            }
        }

        switch ($sort) {
            case 'alpha':
                $qb->orderBy('i.name', 'ASC');
                break;

            case 'year_desc':
                $qb->orderBy('i.year', 'DESC');
                break;

            case 'popularity':
                $qb->leftJoin('i.ratings', 'r')
                ->addSelect('AVG(r.rating) AS HIDDEN avgRating')
                ->groupBy('i.id')
                ->orderBy('avgRating', 'DESC');
                break;
        }

        $qb->distinct(); // avoid duplicates from joins

        return $qb->getQuery()->getResult();
    }

    public function findSuggestionsByQuery(string $q): array
    {
        $qb = $this->createQueryBuilder('i')
            ->select('DISTINCT i.id, i.name, i.year')
            ->leftJoin('i.categories', 'c')
            ->leftJoin('i.tags', 't')
            ->where('LOWER(i.name) LIKE :q')
            ->orWhere('LOWER(i.director) LIKE :q')
            ->orWhere('LOWER(c.genre) LIKE :q')
            ->orWhere('LOWER(t.tagName) LIKE :q')
            ->setParameter('q', '%' . strtolower($q) . '%')
            ->setMaxResults(10);

        return $qb->getQuery()->getArrayResult();
    }


    //    /**
    //     * @return Item[] Returns an array of Item objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('i.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Item
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
