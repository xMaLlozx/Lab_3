<?php

namespace Tukmachev\Shop\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tukmachev\Shop\Database\Factories\ClientFactory;

class Client extends Model
{
    use HasFactory;

    protected $table = 'shop_clients';

    protected $fillable = ['name', 'email', 'phone', 'address', 'city', 'country', 'postal_code'];

    protected static function newFactory()
    {
        return ClientFactory::new();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
