<?php

declare(strict_types=1);

namespace App\Manager;

use App\Repository\HolidayRepository;
use Doctrine\ORM\EntityManagerInterface;

class HolidayManager
{

    public function __construct(
        protected HolidayRepository $holidayRepository,
        protected EntityManagerInterface $entityManager
    ) {
    }

    public function importHolidayByYear(int $year): void
    {
    }
}