<?php

declare(strict_types=1);

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('random_city_weather', [AppRuntime::class, 'getRandomCityWheater']),
            new TwigFunction('today_holiday', [AppRuntime::class, 'getTodayHoliday']),
            new TwigFunction('global_configuration', [AppRuntime::class, 'getGlobalConfiguration']),
        ];
    }
}