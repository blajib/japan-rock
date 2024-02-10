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
class KatakanaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Katakana::class);
    }

//    /**
//     * @return Katakana[] Returns an array of Katakana objects
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

//    public function findOneBySomeField($value): ?Katakana
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
