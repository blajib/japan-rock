<?php

namespace App\DataFixtures;

use App\Entity\Hiragana;
use App\Entity\Katakana;
use App\Symbols\Hiraganas;
use App\Symbols\Katakanas;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        foreach (Katakanas::KATAKANA_SYMBOLS as $level => $katakanaArray) {
            foreach ($katakanaArray as $item) {
                $katakana = new Katakana();
                $katakana->setLevel($level);
                $katakana->setRomaji($item['romaji']);
                $katakana->setJapanese($item['katakana']);
                $manager->persist($katakana);
            }
        }

        foreach (Hiraganas::HIRAGANA_SYMBOLS as $level => $hiraganaArray) {
            foreach ($hiraganaArray as $item) {
                $hiragana = new Hiragana();
                $hiragana->setLevel($level);
                $hiragana->setRomaji($item['romaji']);
                $hiragana->setJapanese($item['hiragana']);
                $manager->persist($hiragana);
            }
        }

        $manager->flush();
    }
}
