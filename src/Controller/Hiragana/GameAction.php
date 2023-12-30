<?php

declare(strict_types=1);

namespace App\Controller\Hiragana;

use App\Form\Type\HiraganaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    '/hiragana/game',
    name: 'hiragana_game',
)]
class GameAction extends AbstractController
{
    public function __invoke(): Response
    {
        $form = $this->createForm(HiraganaType::class);

        return $this->render('hiragana/game.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}