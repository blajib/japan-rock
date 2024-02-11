<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class SymbolRepository extends ServiceEntityRepository
{
    public function findByLevel(int $level): array
    {
        return $this->findBy(['level' => $level]);
    }

    public function findToLevel(int $level): array
    {
        $qb = $this->createQueryBuilder('o');

        $qb
            ->where('o.level <= :level')
            ->setParameter('level', $level)
        ;

        return $qb->getQuery()->getResult();
    }

    public function findLevelChoices(): array
    {
        $qb = $this->createQueryBuilder('o');

        $qb
            ->select('DISTINCT o.level')
        ;

        return $qb->getQuery()->getResult();
    }
}
