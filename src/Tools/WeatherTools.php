<?php

declare(strict_types=1);

namespace App\Tools;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherTools
{

    public function __construct(private readonly HttpClientInterface $client)
    {
    }

    public function getWeather(string $city): array
    {
        $response = $this->client->request(
            'GET',
            'https://api.openweathermap.org/data/2.5/weather?q=' . ucfirst(
                $city
            ) . '&appid=44761feaa8070cfaefad90ca1fd81f37'
        );

        return json_decode($response->getContent(), true);
    }
}