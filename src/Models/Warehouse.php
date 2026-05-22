<?php

namespace Tukmachev\Shop\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tukmachev\Shop\Database\Factories\WarehouseFactory;

class Warehouse extends Model
{
    use HasFactory;

    protected $table = 'shop_warehouses';

    protected $fillable = ['name', 'address', 'city', 'country', 'latitude', 'longitude', 'capacity', 'manager'];

    protected $casts = [
        'latitude'  => 'decimal:6',
        'longitude' => 'decimal:6',
    ];

    protected static function newFactory()
    {
        return WarehouseFactory::new();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'shop_warehouse_stock')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
