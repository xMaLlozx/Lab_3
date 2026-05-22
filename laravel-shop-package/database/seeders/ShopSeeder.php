<?php

namespace Tukmachev\Shop\Database\Seeders;

use Illuminate\Database\Seeder;
use Tukmachev\Shop\Models\Category;
use Tukmachev\Shop\Models\Client;
use Tukmachev\Shop\Models\Order;
use Tukmachev\Shop\Models\Product;
use Tukmachev\Shop\Models\Supplier;
use Tukmachev\Shop\Models\Warehouse;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::factory(5)->create();
        $suppliers  = Supplier::factory(5)->create();
        $clients    = Client::factory(10)->create();
        $warehouses = Warehouse::factory(3)->create();

        $products = Product::factory(20)->create([
            'category_id' => fn() => $categories->random()->id,
            'supplier_id' => fn() => $suppliers->random()->id,
        ]);

        // Наполнить склады товарами
        foreach ($warehouses as $warehouse) {
            $randomProducts = $products->random(rand(5, 15));
            foreach ($randomProducts as $product) {
                $warehouse->products()->attach($product->id, ['quantity' => rand(1, 100)]);
            }
        }

        // Создать заказы
        foreach ($clients->random(5) as $client) {
            Order::factory(rand(1, 3))->create([
                'client_id'    => $client->id,
                'warehouse_id' => $warehouses->random()->id,
            ]);
        }
    }
}
