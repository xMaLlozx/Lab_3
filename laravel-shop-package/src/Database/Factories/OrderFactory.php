<?php

namespace Tukmachev\Shop\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tukmachev\Shop\Models\Client;
use Tukmachev\Shop\Models\Order;
use Tukmachev\Shop\Models\Warehouse;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'client_id'          => Client::factory(),
            'warehouse_id'       => Warehouse::factory(),
            'status'             => $this->faker->randomElement(array_keys(Order::statuses())),
            'total_price'        => $this->faker->randomFloat(2, 10, 50000),
            'delivery_address'   => $this->faker->streetAddress(),
            'delivery_city'      => $this->faker->city(),
            'delivery_country'   => $this->faker->country(),
            'delivery_latitude'  => $this->faker->latitude(),
            'delivery_longitude' => $this->faker->longitude(),
            'delivery_cost'      => $this->faker->randomFloat(2, 0, 500),
            'notes'              => $this->faker->optional()->sentence(),
        ];
    }
}
