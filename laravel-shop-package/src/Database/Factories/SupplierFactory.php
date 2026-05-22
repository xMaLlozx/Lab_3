<?php

namespace Tukmachev\Shop\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tukmachev\Shop\Models\Supplier;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition(): array
    {
        return [
            'name'           => $this->faker->company(),
            'email'          => $this->faker->unique()->companyEmail(),
            'phone'          => $this->faker->phoneNumber(),
            'address'        => $this->faker->address(),
            'country'        => $this->faker->country(),
            'contact_person' => $this->faker->name(),
        ];
    }
}
