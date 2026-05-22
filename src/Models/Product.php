<?php

namespace Tukmachev\Shop\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tukmachev\Shop\Database\Factories\ProductFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'shop_products';

    protected $fillable = [
        'name', 'slug', 'description', 'price', 'stock',
        'sku', 'category_id', 'supplier_id', 'weight', 'is_active',
    ];

    protected $casts = [
        'price'     => 'decimal:2',
        'weight'    => 'decimal:3',
        'is_active' => 'boolean',
    ];

    protected static function newFactory()
    {
        return ProductFactory::new();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function warehouseStocks()
    {
        return $this->belongsToMany(Warehouse::class, 'shop_warehouse_stock')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
