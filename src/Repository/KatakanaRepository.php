<?php

namespace App\Repository;

use App\Entity\Katakana;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Katakana>
 *
 * @method Katakana|null find($id, $lockMode = null, $lockVersion = null)
 * @method Katakana|null findOneBy(array $criteria, array $orderBy = null)
 * @method Katakana[]    findAll()
 * @method Katakana[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KatakanaRepository extends SymbolRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Katakana::class);
    }
}
