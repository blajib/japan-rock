<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Word;
use App\Helper\WordHelper;

class WordManager
{

    public function __construct(private WordHelper $wordHelper, private readonly string $projectDir)
    {
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
}