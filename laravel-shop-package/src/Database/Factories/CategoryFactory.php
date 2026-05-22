<?php

namespace Tukmachev\Shop\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Tukmachev\Shop\Models\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->words(2, true);
        return [
            'name'        => ucfirst($name),
            'slug'        => Str::slug($name),
            'description' => $this->faker->sentence(),
            'parent_id'   => null,
        ];
    }
}
