<?php

namespace App\Repository;

use App\Entity\Hiragana;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Hiragana>
 *
 * @method Hiragana|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hiragana|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hiragana[]    findAll()
 * @method Hiragana[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HiraganaRepository extends SymbolRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hiragana::class);
    }

}
