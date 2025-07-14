<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
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
