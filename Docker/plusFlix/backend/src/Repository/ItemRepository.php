<?php

namespace App\Repository;

use App\Entity\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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

        if (!empty($filters['tags'])) {
            $qb->leftJoin('i.tags', 't')
                ->andWhere($qb->expr()->in('t.id', ':tags'))
                ->setParameter('tags', $filters['tags']);
        }

        if (!empty($filters['streamings'])) {
            $qb->leftJoin('i.streamings', 's')
                ->andWhere($qb->expr()->in('s.id', ':streamings'))
                ->setParameter('streamings', $filters['streamings']);
        }

        $qb->distinct(); // avoid duplicates from joins

        return $qb->getQuery()->getResult();
    }
    //julkowe
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
}
