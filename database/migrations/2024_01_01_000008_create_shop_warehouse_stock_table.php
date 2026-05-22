<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shop_warehouse_stock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained('shop_warehouses')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('shop_products')->cascadeOnDelete();
            $table->unsignedInteger('quantity')->default(0);
            $table->timestamps();

            $table->unique(['warehouse_id', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shop_warehouse_stock');
    }
};
