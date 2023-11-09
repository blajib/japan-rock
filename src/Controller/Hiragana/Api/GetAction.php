<?php

declare(strict_types=1);

namespace App\Controller\Hiragana\Api;

use App\Symbols\Hiragana;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetAction extends AbstractController
{
    #[Route(
        '/hiragana/get/{level}',
        name: 'hiragana-get',
    )]
    public function __invoke(string $level = '1'): JsonResponse
    {
        $hiraganas = [];
        $level = (int) $level;

        for ($i = 1; $i <= $level; $i++) {
            $hiraganas = array_merge($hiraganas, Hiragana::HIRAGANA_SYMBOLS[$i]);
        }

        return new JsonResponse($hiraganas);
    }
}