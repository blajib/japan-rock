<?php

declare(strict_types=1);

namespace App\Controller\Hiragana\Api;

use App\Symbols\Hiragana;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetGroupAction extends AbstractController
{
    #[Route(
        '/hiragana/get-group/{level}',
        name: 'hiragana-get-group',
    )]
    public function __invoke(string $level = '1'): JsonResponse
    {
        return new JsonResponse(Hiragana::HIRAGANA_SYMBOLS[$level]);
    }
}