<?php

namespace App\Repository;

use App\Entity\GlobalConfiguration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GlobalConfiguration>
 */
class GlobalConfigurationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GlobalConfiguration::class);
    }

    public function singleton()
    {
        return $this->find(1);
    }
}
