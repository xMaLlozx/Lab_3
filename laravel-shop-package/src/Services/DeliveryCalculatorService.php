<?php

namespace Tukmachev\Shop\Services;

use GuzzleHttp\Client;

class DeliveryCalculatorService
{
    protected Client $http;
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->http   = new Client(['timeout' => 10]);
    }

    /**
     * Рассчитать стоимость доставки из точки A в точку B.
     *
     * @param float $latA  широта склада
     * @param float $lonA  долгота склада
     * @param float $latB  широта доставки
     * @param float $lonB  долгота доставки
     * @return array ['distance_km' => float, 'cost' => float, 'driver' => string]
     */
    public function calculate(float $latA, float $lonA, float $latB, float $lonB): array
    {
        $driver     = $this->config['driver'];
        $distanceKm = match ($driver) {
            'openroute' => $this->distanceViaOpenRoute($latA, $lonA, $latB, $lonB),
            'osrm'      => $this->distanceViaOSRM($latA, $lonA, $latB, $lonB),
            default     => $this->distanceHaversine($latA, $lonA, $latB, $lonB),
        };

        $rate = (float) ($this->config['rate_per_km'] ?? 0.5);

        return [
            'distance_km' => round($distanceKm, 2),
            'cost'        => round($distanceKm * $rate, 2),
            'driver'      => $driver,
        ];
    }

    /**
     * Метод 1 (математический): формула Гаверсинуса.
     * Вычисляет расстояние по большому кругу между двумя точками на сфере.
     */
    public function distanceHaversine(float $latA, float $lonA, float $latB, float $lonB): float
    {
        $R    = 6371.0; // радиус Земли в км
        $dLat = deg2rad($latB - $latA);
        $dLon = deg2rad($lonB - $lonA);

        $a = sin($dLat / 2) ** 2
           + cos(deg2rad($latA)) * cos(deg2rad($latB)) * sin($dLon / 2) ** 2;

        return $R * 2 * asin(sqrt($a));
    }

    /**
     * Метод 2 (гео-сервис): OpenRouteService — реальное расстояние по дорогам.
     * Требует бесплатный ключ: openrouteservice.org
     */
    protected function distanceViaOpenRoute(float $latA, float $lonA, float $latB, float $lonB): float
    {
        $key      = $this->config['openroute_key'];
        $response = $this->http->post('https://api.openrouteservice.org/v2/directions/driving-car', [
            'headers' => [
                'Authorization' => $key,
                'Content-Type'  => 'application/json',
            ],
            'json' => [
                'coordinates' => [[$lonA, $latA], [$lonB, $latB]],
            ],
        ]);

        $data    = json_decode($response->getBody()->getContents(), true);
        $meters  = $data['routes'][0]['summary']['distance'] ?? 0;

        return $meters / 1000;
    }

    /**
     * Метод 3 (гео-сервис): OSRM (Project OSRM) — бесплатный, без ключа.
     * Использует публичный демо-сервер OpenStreetMap.
     */
    protected function distanceViaOSRM(float $latA, float $lonA, float $latB, float $lonB): float
    {
        $base     = rtrim($this->config['osrm_base_url'] ?? 'https://router.project-osrm.org', '/');
        $url      = "{$base}/route/v1/driving/{$lonA},{$latA};{$lonB},{$latB}";
        $response = $this->http->get($url, ['query' => ['overview' => 'false']]);

        $data    = json_decode($response->getBody()->getContents(), true);
        $meters  = $data['routes'][0]['distance'] ?? 0;

        return $meters / 1000;
    }
}
