<?php

namespace Tukmachev\Shop\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Tukmachev\Shop\Models\Category;
use Tukmachev\Shop\Models\Product;
use Tukmachev\Shop\Models\Supplier;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);
        return [
            'name'        => ucfirst($name),
            'slug'        => Str::slug($name),
            'description' => $this->faker->paragraph(),
            'price'       => $this->faker->randomFloat(2, 1, 9999),
            'stock'       => $this->faker->numberBetween(0, 500),
            'sku'         => strtoupper($this->faker->unique()->lexify('SKU-??????')),
            'category_id' => Category::factory(),
            'supplier_id' => Supplier::factory(),
            'weight'      => $this->faker->randomFloat(3, 0.1, 50),
            'is_active'   => $this->faker->boolean(85),
        ];
    }
}
