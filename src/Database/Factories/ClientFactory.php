<?php

namespace Tukmachev\Shop\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tukmachev\Shop\Models\Client;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'name'        => $this->faker->name(),
            'email'       => $this->faker->unique()->safeEmail(),
            'phone'       => $this->faker->phoneNumber(),
            'address'     => $this->faker->streetAddress(),
            'city'        => $this->faker->city(),
            'country'     => $this->faker->country(),
            'postal_code' => $this->faker->postcode(),
        ];
    }
}
