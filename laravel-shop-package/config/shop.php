<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Route prefix
    |--------------------------------------------------------------------------
    | Внутренний префикс для всех маршрутов пакета.
    | Пример: 'shop' даст /shop/products, /shop/orders и т.д.
    */
    'route_prefix' => env('SHOP_ROUTE_PREFIX', 'shop'),

    /*
    |--------------------------------------------------------------------------
    | Currency Rate Settings
    |--------------------------------------------------------------------------
    | Настройки сервиса получения актуального курса валют.
    | driver: 'frankfurter' | 'exchangerate'
    */
    'currency' => [
        'driver'   => env('SHOP_CURRENCY_DRIVER', 'frankfurter'),
        'base'     => env('SHOP_CURRENCY_BASE', 'USD'),
        'api_key'  => env('SHOP_EXCHANGERATE_KEY', ''),
        'cache_ttl' => 3600,
    ],

    /*
    |--------------------------------------------------------------------------
    | Delivery Calculator Settings
    |--------------------------------------------------------------------------
    | driver: 'openroute' | 'osrm' | 'haversine'
    | openroute и osrm — онлайн гео-сервисы, haversine — математический метод.
    */
    'delivery' => [
        'driver'         => env('SHOP_DELIVERY_DRIVER', 'haversine'),
        'rate_per_km'    => env('SHOP_DELIVERY_RATE', 0.5),
        'openroute_key'  => env('SHOP_OPENROUTE_KEY', ''),
        'osrm_base_url'  => env('SHOP_OSRM_URL', 'https://router.project-osrm.org'),
    ],
];
