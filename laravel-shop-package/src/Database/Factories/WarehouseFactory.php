<?php

namespace Tukmachev\Shop\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tukmachev\Shop\Models\Warehouse;

class WarehouseFactory extends Factory
{
    protected $model = Warehouse::class;

    public function definition(): array
    {
        return [
            'name'      => $this->faker->company() . ' Warehouse',
            'address'   => $this->faker->streetAddress(),
            'city'      => $this->faker->city(),
            'country'   => $this->faker->country(),
            'latitude'  => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'capacity'  => $this->faker->numberBetween(100, 10000),
            'manager'   => $this->faker->name(),
        ];
    }
}
