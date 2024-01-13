<?php

declare(strict_types=1);

namespace App\Command;

use App\Api\HolidayApi;
use App\Entity\Holiday;
use App\Repository\HolidayRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'import:holiday',
    description: 'Importer les jours fèriés',
)]
class GetHolidayCommand extends Command
{

    public function __construct(
        private HolidayRepository $holidayRepository,
        private HolidayApi $holidayApi,
        private EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if ($this->holidayRepository->findByYear()) {
            $io->error("Les fêtes de l'année on déja été importées");

            return Command::FAILURE;
        }

        $holidaysArray = $this->holidayApi->getHolidaysYear();

        if (empty($holidaysArray)) {
            $io->error("Les fêtes de l'année on déja été importées");

            return Command::FAILURE;
        }

        foreach ($holidaysArray as $holidayLine) {
            $holiday = new Holiday();
            $holiday->setEnglishTranslate($holidayLine['name']);
            $holiday->setJapanTranslate($holidayLine['localName']);
            $holiday->setDate(new \DateTime($holidayLine['date']));
            $this->entityManager->persist($holiday);
        }

        $this->entityManager->flush();

        $io->success("l'ajout des jours de fête à bien été effectué");

        return Command::SUCCESS;
    }
}