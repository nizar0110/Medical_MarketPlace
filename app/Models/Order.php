<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Les attributs qui peuvent être assignés en masse.
     */
    protected $fillable = [
        'client_id',
        'status',
        'total',
        'payment_status',
        'shipping_address',
        'shipping_phone',
        'payment_method',
        'order_number'
    ];

    /**
     * La commande appartient à un client
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * La commande a plusieurs OrderItems
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
