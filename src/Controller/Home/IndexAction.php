<?php

declare(strict_types=1);

namespace App\Controller\Home;

use App\Manager\WordManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    '/',
    name: 'home',
)]
class IndexAction extends AbstractController
{
    public function __invoke(WordManager $wordManager): Response
    {
        dd($wordManager->getRandomWordGroup(3));

        return $this->render('home/index.html.twig',[
            'bite' => 'grosse bite'
        ]);
    }
}