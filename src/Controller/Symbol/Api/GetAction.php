<?php

declare(strict_types=1);

namespace App\Controller\Symbol\Api;

use App\Repository\HiraganaRepository;
use App\Repository\KatakanaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetAction extends AbstractController
{
    use ApiTrait;

    #[Route(
        '/symbol/get/{symbol}/{level}',
        name: 'symbol-get',
    )]
    public function __invoke(
        HiraganaRepository $hiraganaRepository,
        KatakanaRepository $katakanaRepository,
        ?string $symbol = 'hiragana',
        ?string $level = '1'
    ): JsonResponse {
        if ($symbol === 'hiragana') {
            $result = $hiraganaRepository->findToLevel((int) $level);
        } else {
            $result = $katakanaRepository->findToLevel((int) $level);
        }

        return new JsonResponse($this->serializeResult($result));
    }
}