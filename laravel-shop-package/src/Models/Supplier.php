<?php

namespace Tukmachev\Shop\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tukmachev\Shop\Database\Factories\SupplierFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'shop_suppliers';

    protected $fillable = ['name', 'email', 'phone', 'address', 'country', 'contact_person'];

    protected static function newFactory()
    {
        return SupplierFactory::new();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
