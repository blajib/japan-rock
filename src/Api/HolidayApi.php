<?php

declare(strict_types=1);

namespace App\Api;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class HolidayApi
{
    public function __construct(private readonly HttpClientInterface $client)
    {
    }

    public function getHolidaysYear(): array
    {
        $year = date('Y');

        $response = $this->client->request(
            'GET',
            'https://date.nager.at/api/v3/publicholidays/' . $year . '/JP'
        );

        return json_decode($response->getContent(), true);
    }


}