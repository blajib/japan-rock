<?php

declare(strict_types=1);

namespace App\Controller\Symbol;

use App\Form\Type\SymbolType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    '/symbol/game',
    name: 'symbol_game',
)]
class GameAction extends AbstractController
{
    public function __invoke(): Response
    {
        $form = $this->createForm(SymbolType::class);

        return $this->render('symbol/game.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}