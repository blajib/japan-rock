<?php

declare(strict_types=1);

namespace App\Controller\Hiragana;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    '/hiragana/game',
    name: 'hiragana-game',
)]
class GameAction extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('hiragana/game.html.twig');
    }
}