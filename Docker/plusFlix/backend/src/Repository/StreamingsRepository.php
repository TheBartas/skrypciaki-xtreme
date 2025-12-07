<?php

namespace App\Repository;

use App\Entity\Streamings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Streamings>
 */
class StreamingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Streamings::class);
    }

    public function findWithItemCount(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "
            SELECT
                s.streaming_ID,
                s.platform_name,
                COUNT(is_tbl.item_id) AS item_count
            FROM Streamings s
            LEFT JOIN Item_Streamings is_tbl ON s.streaming_ID = is_tbl.streaming_ID
            GROUP BY s.streaming_ID, s.platform_name
            ORDER BY s.platform_name
        ";
        return $conn->executeQuery($sql)->fetchAllAssociative();
    }
}
