<?php

namespace Tukmachev\Shop\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tukmachev\Shop\Database\Factories\OrderFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'shop_orders';

    protected $fillable = [
        'client_id', 'warehouse_id', 'status', 'total_price',
        'delivery_address', 'delivery_city', 'delivery_country',
        'delivery_latitude', 'delivery_longitude',
        'delivery_cost', 'notes',
    ];

    protected $casts = [
        'total_price'        => 'decimal:2',
        'delivery_cost'      => 'decimal:2',
        'delivery_latitude'  => 'decimal:6',
        'delivery_longitude' => 'decimal:6',
    ];

    const STATUS_NEW        = 'new';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SHIPPED    = 'shipped';
    const STATUS_DELIVERED  = 'delivered';
    const STATUS_CANCELLED  = 'cancelled';

    public static function statuses(): array
    {
        return [
            self::STATUS_NEW        => 'Новый',
            self::STATUS_PROCESSING => 'В обработке',
            self::STATUS_SHIPPED    => 'Отправлен',
            self::STATUS_DELIVERED  => 'Доставлен',
            self::STATUS_CANCELLED  => 'Отменён',
        ];
    }

    protected static function newFactory()
    {
        return OrderFactory::new();
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
