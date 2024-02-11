<?php

declare(strict_types=1);

namespace App\Controller\Symbol\Api;

use App\Repository\HiraganaRepository;
use App\Repository\KatakanaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetGroupAction extends AbstractController
{
    use ApiTrait;

    #[Route(
        '/symbol/get-group/{symbol}/{level}',
        name: 'symbol-get-group',
    )]
    public function __invoke(
        HiraganaRepository $hiraganaRepository,
        KatakanaRepository $katakanaRepository,
        ?string $symbol = 'hiragana',
        ?string $level = '1'
    ): JsonResponse {
        if ($symbol === 'hiragana') {
            $symbols = $hiraganaRepository->findByLevel((int) $level);
        } else {
            $symbols = $katakanaRepository->findByLevel((int) $level);
        }

        return new JsonResponse($this->serializeResult($symbols));
    }
}