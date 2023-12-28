<?php

namespace App\Test\Controller;

use App\Entity\Word;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WordControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/word/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Word::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Word index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'word[japanTranslate]' => 'Testing',
            'word[frenchTranslate]' => 'Testing',
            'word[wordGroup]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Word();
        $fixture->setJapanTranslate('My Title');
        $fixture->setFrenchTranslate('My Title');
        $fixture->setWordGroup('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Word');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Word();
        $fixture->setJapanTranslate('Value');
        $fixture->setFrenchTranslate('Value');
        $fixture->setWordGroup('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'word[japanTranslate]' => 'Something New',
            'word[frenchTranslate]' => 'Something New',
            'word[wordGroup]' => 'Something New',
        ]);

        self::assertResponseRedirects('/word/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getJapanTranslate());
        self::assertSame('Something New', $fixture[0]->getFrenchTranslate());
        self::assertSame('Something New', $fixture[0]->getWordGroup());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Word();
        $fixture->setJapanTranslate('Value');
        $fixture->setFrenchTranslate('Value');
        $fixture->setWordGroup('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/word/');
        self::assertSame(0, $this->repository->count([]));
    }
}
