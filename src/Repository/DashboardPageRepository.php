<?php

namespace App\Repository;

use App\Entity\DashboardPage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DashboardPage>
 */
class DashboardPageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DashboardPage::class);
    }

    public function singleton()
    {
        return $this->find(1);
    }
}
