<?php

namespace App\Command;

use App\Entity\WordGroup;
use App\Manager\WordManager;
use App\Repository\WordGroupRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'day:word:group',
    description: 'Récupérer les mots du jour',
)]
class GetDayWordGroupCommand extends Command
{
    public function __construct(
        private readonly WordManager $worldManager,
        private readonly EntityManagerInterface $entityManager,
        private readonly WordGroupRepository $wordGroupRepository
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $wordGroup = $this->wordGroupRepository->findByDate(new \DateTime('midnight'));

        if (\count($wordGroup) > 0) {
            $io->error("L'ajout des mots de la journée à déja été effectué");

            return 0;
        }

        $words = $this->worldManager->getRandomWordGroup(3);

        $wordGroup = new WordGroup();

        $wordGroup->setDate(new \DateTime('midnight'));
        $wordGroup->setWords($words);

        try {
            $this->entityManager->persist($wordGroup);
            $this->entityManager->flush();
        } catch (\Throwable $e) {
            throw new \RuntimeException("Une erreur est survenue lors de l'ajout des nouveaux mots de la journée");
        }

        $io->success("L'ajout des nouveaux mots de la jounrée à bien été effectué");

        return Command::SUCCESS;
    }
}
