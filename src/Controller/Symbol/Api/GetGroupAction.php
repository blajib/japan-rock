<?php

declare(strict_types=1);

namespace App\Controller\Symbol\Api;

use App\Repository\HiraganaRepository;
use App\Repository\KatakanaRepository;
use App\Repository\SymbolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetGroupAction extends AbstractController
{
    use ApiTrait;

    #[Route(
        '/symbol/get-group/{type}/{level}',
        name: 'symbol-get-group',
    )]
    public function __invoke(
        SymbolRepository $symbolRepository,
        ?string $type = 'hiragana',
        ?string $level = '1'
    ): JsonResponse {
        $symbols = $symbolRepository->findByLevel((int) $level, $type);

        return new JsonResponse($this->serializeResult($symbols));
    }
}