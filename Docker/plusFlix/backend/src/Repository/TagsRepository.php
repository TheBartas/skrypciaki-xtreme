<?php

namespace App\Repository;

use App\Entity\Tags;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tags>
 */
class TagsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tags::class);
    }

    public function findWithItemCount(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "
            SELECT
                t.tag_ID,
                t.name,
                COUNT(it.item_id) AS item_count
            FROM Tags t
            LEFT JOIN Item_Tags it ON t.tag_ID = it.tag_ID
            GROUP BY t.tag_ID, t.name
            ORDER BY t.name
        ";
        return $conn->executeQuery($sql)->fetchAllAssociative();
    }
}
