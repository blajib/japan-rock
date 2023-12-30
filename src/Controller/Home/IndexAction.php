<?php

declare(strict_types=1);

namespace App\Controller\Home;

use App\Manager\WordManager;
use App\Repository\WordGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    '/',
    name: 'home',
)]
class IndexAction extends AbstractController
{
    public function __invoke(WordManager $wordManager, WordGroupRepository $groupRepository): Response
    {
        $wordGroup = $groupRepository->findByDate(new \DateTime());

        if (null === $wordGroup) {
            $wordGroup = $wordManager->initDayWordGroup();
        }

        return $this->render('home/index.html.twig', [
            'words' => $wordGroup->getWords(),
        ]);
    }
}