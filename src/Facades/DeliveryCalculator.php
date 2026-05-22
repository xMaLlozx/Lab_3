<?php

namespace Tukmachev\Shop\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array  calculate(float $latA, float $lonA, float $latB, float $lonB)
 * @method static float  distanceHaversine(float $latA, float $lonA, float $latB, float $lonB)
 *
 * @see \Tukmachev\Shop\Services\DeliveryCalculatorService
 */
class DeliveryCalculator extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'delivery-calculator';
    }
}
