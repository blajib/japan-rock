<?php

namespace App\DataFixtures;

use App\Entity\DashboardPage;
use App\Entity\GlobalConfiguration;
use App\Entity\Kanji;
use App\Entity\Symbol;
use App\Entity\User;
use App\Helper\HolidayHelper;
use App\Symbols\Hiraganas;
use App\Symbols\Katakanas;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly HolidayHelper $holidayHelper,
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadSymbols($manager);
        $this->loadMainUser($manager);
        $this->loadDashboardPage($manager);
        $this->loadGlobalConfiguration($manager);
    }

    private function loadSymbols(ObjectManager $manager): void
    {
        $kanjiFile = file_get_contents('public/kanji.json');
        $kanjis = json_decode($kanjiFile, true, 512, JSON_THROW_ON_ERROR);

        foreach ($kanjis as $key => $item) {
            $kanji = new Kanji();
            $kanji->setLevel($item['grade']);
            $kanji->setIdeogram($key);
            $kanji->setHiragana(implode(', ', $item['readings_on']));
            $kanji->setMeaning(implode(', ', $item['meanings']));
            $manager->persist($kanji);
        }

        foreach (Katakanas::KATAKANA_SYMBOLS as $level => $katakanaArray) {
            foreach ($katakanaArray as $item) {
                $katakana = new Symbol();
                $katakana->setLevel($level);
                $katakana->setRomaji($item['romaji']);
                $katakana->setJapanese($item['katakana']);
                $katakana->setType('katakana');
                $manager->persist($katakana);
            }
        }

        foreach (Hiraganas::HIRAGANA_SYMBOLS as $level => $hiraganaArray) {
            foreach ($hiraganaArray as $item) {
                $hiragana = new Symbol();
                $hiragana->setLevel($level);
                $hiragana->setRomaji($item['romaji']);
                $hiragana->setJapanese($item['hiragana']);
                $hiragana->setType('hiragana');
                $manager->persist($hiragana);
            }
        }

        file_get_contents('public/kanji.json');

        $this->holidayHelper->insertHolidays();

        $manager->flush();
    }

    private function loadMainUser(ObjectManager $manager): void
    {
        $user = new User();
        $password = 'california';
        $user->setRoles(['ROLE_ADMIN']);
        $user->setUsername('jib');
        $user->setEmail('blaschka@gmail.com');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $password
        );
        $user->setPassword($hashedPassword);

        $manager->persist($user);
        $manager->flush();
    }

    private function loadDashboardPage(ObjectManager $manager): void
    {
        $page = new DashboardPage();
        $page->setId(1);
        $page->setTitle('Default title');

        $manager->persist($page);
        $manager->flush();
    }

    private function loadGlobalConfiguration(ObjectManager $manager): void
    {
        $configuration = new GlobalConfiguration();
        $configuration->setId(1);

        $manager->persist($configuration);
        $manager->flush();
    }
}
