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
class HiraganaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hiragana::class);
    }

//    /**
//     * @return Hiragana[] Returns an array of Hiragana objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Hiragana
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
