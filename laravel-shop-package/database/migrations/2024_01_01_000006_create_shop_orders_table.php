<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shop_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('shop_clients')->cascadeOnDelete();
            $table->foreignId('warehouse_id')->nullable()->constrained('shop_warehouses')->nullOnDelete();
            $table->string('status')->default('new');
            $table->decimal('total_price', 12, 2)->default(0);
            $table->text('delivery_address')->nullable();
            $table->string('delivery_city')->nullable();
            $table->string('delivery_country', 100)->nullable();
            $table->decimal('delivery_latitude', 10, 6)->nullable();
            $table->decimal('delivery_longitude', 10, 6)->nullable();
            $table->decimal('delivery_cost', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shop_orders');
    }
};
