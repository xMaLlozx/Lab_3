<?php

namespace Tukmachev\Shop\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static float  getRate(string $currency)
 * @method static array  getAllRates(?string $base = null)
 * @method static float  convert(float $amount, string $from, string $to)
 *
 * @see \Tukmachev\Shop\Services\CurrencyRateService
 */
class CurrencyRate extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'currency-rate';
    }
}
