<?php

namespace App\Repository;

use App\Entity\Holiday;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Holiday>
 *
 * @method Holiday|null find($id, $lockMode = null, $lockVersion = null)
 * @method Holiday|null findOneBy(array $criteria, array $orderBy = null)
 * @method Holiday[]    findAll()
 * @method Holiday[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HolidayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Holiday::class);
    }

    public function findByYear(): array
    {
        $date = new \DateTime('now');

        $qb = $this->createQueryBuilder('o');

        $qb
            ->where('YEAR(o.date) = :year')
            ->setParameter('year', $date->format('Y'))
        ;

        return $qb->getQuery()->getResult();
    }

    public function findByDay(\DateTime $date): array
    {
        $dateString = $date->format('Y-m-d');

        return $this->findBy(['date' => new \DateTime($dateString)]);
    }
}
