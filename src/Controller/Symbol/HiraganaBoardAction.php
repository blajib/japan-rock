<?php

declare(strict_types=1);

namespace App\Controller\Symbol;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HiraganaBoardAction extends AbstractController
{
    #[Route(
        '/hiragana/board',
        name: 'hiragana_board',
    )]
    public function __invoke(string $level = '1'): Response
    {
        return $this->render('symbol/board.html.twig');
    }
}