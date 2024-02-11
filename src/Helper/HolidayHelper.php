<?php

declare(strict_types=1);

namespace App\Helper;

use App\Api\HolidayApi;
use App\Entity\Holiday;
use App\Repository\HolidayRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;

class HolidayHelper
{
    public function __construct(
        private readonly HolidayRepository $holidayRepository,
        private readonly HolidayApi $holidayApi,
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    public function insertHolidays(): int
    {
        if ($this->holidayRepository->findByYear()) {
            throw new \Exception("Les fêtes de l'année on déja été importées");
        }

        $holidaysArray = $this->holidayApi->getHolidaysYear();

        if (empty($holidaysArray)) {
            throw new \Exception("Les fêtes de l'année on déja été importées");
        }

        foreach ($holidaysArray as $holidayLine) {
            $holiday = new Holiday();
            $holiday->setEnglishTranslate($holidayLine['name']);
            $holiday->setJapanTranslate($holidayLine['localName']);
            $holiday->setDate(new \DateTime($holidayLine['date']));
            $this->entityManager->persist($holiday);
        }

        $this->entityManager->flush();

        return Command::SUCCESS;
    }
}