<?php

declare(strict_types=1);

namespace App\Controller\Symbol\Api;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

trait ApiTrait
{
    private function getSerializer(): Serializer
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        return new Serializer($normalizers, $encoders);
    }

    private function serializeResult(array $result): array
    {
        $serializer = $this->getSerializer();
        $serializeArray = [];

        foreach ($result as $item) {
            $serializeArray[] = $serializer->serialize($item, 'json');
        }

        return $serializeArray;
    }
}
