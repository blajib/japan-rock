<?php

declare(strict_types=1);

namespace App\Controller\Home;

use App\Manager\WordManager;
use App\Repository\DashboardPageRepository;
use App\Repository\WordGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[Route(
    '/',
    name: 'home',
)]
class IndexAction extends AbstractController
{
    public function __invoke(
        WordManager $wordManager,
        WordGroupRepository $groupRepository,
        HttpClientInterface $client,
        DashboardPageRepository $pageRepository
    ): Response {
        $wordGroup = $groupRepository->findByDate(new \DateTime());
        $dashboardPage = $pageRepository->singleton();

        if (null === $wordGroup) {
            $wordGroup = $wordManager->initDayWordGroup();
        }

        return $this->render('home/index.html.twig', [
            'words'          => $wordGroup->getWords(),
            'dashboard_page' => $dashboardPage,
        ]);
    }
}