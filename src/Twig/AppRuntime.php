<?php

declare(strict_types=1);

namespace App\Twig;

use App\Api\WeatherApi;
use App\Entity\GlobalConfiguration;
use App\Repository\GlobalConfigurationRepository;
use App\Repository\HolidayRepository;
use Twig\Extension\RuntimeExtensionInterface;

class AppRuntime implements RuntimeExtensionInterface
{

    public function __construct(
        private readonly WeatherApi $weatherApi,
        private array $japaneseCities,
        private readonly HolidayRepository $holidayRepository,
        private readonly GlobalConfigurationRepository $globalConfigurationRepository,
    ) {
    }

    public function getRandomCityWheater(): array
    {
        shuffle($this->japaneseCities);

        return $this->weatherApi->getWeather($this->japaneseCities[0]);
    }

    public function getTodayHoliday(): array
    {
        $date = new \DateTime('now');

        return $this->holidayRepository->findByDay($date);
    }

    public function getGlobalConfiguration(): ?GlobalConfiguration
    {
        return $this->globalConfigurationRepository->singleton();
    }
}