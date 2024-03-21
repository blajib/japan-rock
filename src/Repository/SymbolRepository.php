<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Symbol;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SymbolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Symbol::class);
    }

    public function findByLevel(int $level, string $type): array
    {
        return $this->findBy(['level' => $level, 'type' => $type]);
    }

    public function findToLevel(int $level, string $type): array
    {
        $qb = $this->createQueryBuilder('o');

        $qb
            ->where('o.level <= :level')
            ->andWhere('o.type = :type')
            ->setParameters([
                'level' => $level,
                'type'  => $type,
            ])
        ;

        return $qb->getQuery()->getResult();
    }

    public function findLevelChoices(string $type): array
    {
        $qb = $this->createQueryBuilder('o');

        $qb
            ->select('DISTINCT o.level')
            ->where('o.type = :type')
            ->setParameter('type', $type)
        ;

        return $qb->getQuery()->getResult();
    }
}
