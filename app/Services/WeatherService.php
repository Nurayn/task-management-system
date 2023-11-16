<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use RakibDevs\Weather\Weather;
/**
 * Class WeatherService.
 */
class WeatherService
{
    public function getWeatherByCoordinates($lat, $lon)
    {
        $cacheKey = 'weather_' . $lat . '_' . $lon;
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }
        $openWeather = new Weather();
        $weather = $openWeather->getCurrentByCord((int)$lat, (int)$lon);

        Cache::put($cacheKey, $weather, now()->addHours(1));

        return $weather;
    }
}
