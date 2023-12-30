<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Word;
use App\Entity\WordGroup;
use App\Helper\WordHelper;
use Doctrine\ORM\EntityManagerInterface;

class WordManager
{
    public function __construct(
        private readonly WordHelper $wordHelper,
        private readonly EntityManagerInterface $entityManager,
        private readonly string $projectDir
    ) {
    }

    public function getRandomWord(): string
    {
        return $this->getDictionary()[array_rand($this->getDictionary())];
    }

    public function getRandomWordGroup(int $count): array
    {
        $result = [];
        $dico = $this->getDictionary();

        for ($i = 1; $i <= $count; $i++) {
            $formatLine = $this->wordHelper->formatWordLine($dico[array_rand($dico)]);

            $word = new Word();
            $word->setFrenchTranslate($formatLine['france']);
            $word->setJapanTranslate($formatLine['japan']);

            $result[] = $word;
        }

        return $result;
    }

    private function getDictionary(): array
    {
        return file($this->projectDir . '/dico.txt');
    }

    public function initDayWordGroup(): WordGroup
    {
        $words = $this->getRandomWordGroup(3);

        $wordGroup = new WordGroup();

        $wordGroup->setDate(new \DateTime('midnight'));
        $wordGroup->setWords($words);

        try {
            $this->entityManager->persist($wordGroup);
            $this->entityManager->flush();
        } catch (\Throwable $e) {
            throw new \RuntimeException("Une erreur est survenue lors de l'ajout des nouveaux mots de la journée");
        }

        return $wordGroup;
    }
}