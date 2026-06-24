<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Order.php
protected static function boot()
{
    parent::boot();

    static::creating(function ($order) {
        $order->order_number = 'ORD-' . date('Ymd') . '-' . str_pad(
            (Order::whereDate('created_at', today())->count() + 1),
            3, '0', STR_PAD_LEFT
        );
    });
}
    protected $fillable = [
        'type',
        'user_id',
        'order_number',
        'payment_method',
        'total_amount',
        'payment_status',
        'created_at',
        'updated_at',
        'paid_at',
        'order_name',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}
