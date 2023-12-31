<?php

declare(strict_types=1);

namespace App\Twig;

use App\Tools\WeatherTools;
use Twig\Extension\RuntimeExtensionInterface;

class AppRuntime implements RuntimeExtensionInterface
{

    public function __construct(private WeatherTools $weatherTools, private array $japaneseCities)
    {
    }

    public function getRandomCityWheater(): array
    {
        shuffle($this->japaneseCities);

        return $this->weatherTools->getWeather($this->japaneseCities[0]);
    }
}