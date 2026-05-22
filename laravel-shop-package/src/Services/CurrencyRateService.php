<?php

namespace Tukmachev\Shop\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class CurrencyRateService
{
    protected Client $http;
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->http   = new Client(['timeout' => 10]);
    }

    /**
     * Получить курс валюты относительно базовой.
     * Пример: getRate('EUR') — сколько EUR за 1 USD (если base=USD)
     */
    public function getRate(string $currency): float
    {
        $rates = $this->getAllRates();
        return $rates[$currency] ?? throw new \InvalidArgumentException("Unknown currency: $currency");
    }

    /**
     * Получить все доступные курсы (кешируется на cache_ttl секунд).
     */
    public function getAllRates(?string $base = null): array
    {
        $base    = $base ?? $this->config['base'];
        $cacheKey = "shop_rates_{$base}";
        $ttl      = $this->config['cache_ttl'] ?? 3600;

        return Cache::remember($cacheKey, $ttl, function () use ($base) {
            return match ($this->config['driver']) {
                'exchangerate' => $this->fetchFromExchangeRate($base),
                default        => $this->fetchFromFrankfurter($base),
            };
        });
    }

    /**
     * Конвертировать сумму из одной валюты в другую.
     */
    public function convert(float $amount, string $from, string $to): float
    {
        if ($from === $to) {
            return $amount;
        }

        $rates = $this->getAllRates($from);
        $rate  = $rates[$to] ?? throw new \InvalidArgumentException("Cannot convert to $to");

        return round($amount * $rate, 2);
    }

    // Бесплатный публичный API — ключ не нужен
    protected function fetchFromFrankfurter(string $base): array
    {
        $response = $this->http->get("https://api.frankfurter.app/latest", [
            'query' => ['from' => $base],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
        return $data['rates'] ?? [];
    }

    // exchangerate-api.com — требует бесплатный API-ключ
    protected function fetchFromExchangeRate(string $base): array
    {
        $key      = $this->config['api_key'];
        $response = $this->http->get("https://v6.exchangerate-api.com/v6/{$key}/latest/{$base}");
        $data     = json_decode($response->getBody()->getContents(), true);
        return $data['conversion_rates'] ?? [];
    }
}
