<?php

declare(strict_types=1);

namespace App\Api;

use App\Repository\GlobalConfigurationRepository;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Throwable;

class WeatherApi
{

    public function __construct(
        private readonly HttpClientInterface $client,
        private readonly GlobalConfigurationRepository $globalConfigurationRepository
    ) {
    }

    public function getWeather(string $city): ?array
    {
        $globalConfiguration = $this->globalConfigurationRepository->singleton();

        $response = $this->client->request(
            'GET',
            sprintf(
                'https://api.openweathermap.org/data/2.5/weather?q=%s&units=metric&appid=%s',
                ucfirst($city),
                $globalConfiguration->getWeatherApiId()
            )
        );

        $result = null;

        try {
            $result = json_decode($response->getContent(), true);
        } catch (Throwable $e) {
        }

        return $result;
    }
}
