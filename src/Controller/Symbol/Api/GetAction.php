<?php

declare(strict_types=1);

namespace App\Controller\Symbol\Api;

use App\Repository\HiraganaRepository;
use App\Repository\KatakanaRepository;
use App\Repository\SymbolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetAction extends AbstractController
{
    use ApiTrait;

    #[Route(
        '/symbol/get/{type}/{level}',
        name: 'symbol-get',
    )]
    public function __invoke(
        SymbolRepository $symbolRepository,
        ?string $type = 'hiragana',
        ?string $level = '1'
    ): JsonResponse {
        $result = $symbolRepository->findToLevel((int) $level, $type);

        return new JsonResponse($this->serializeResult($result));
    }
}