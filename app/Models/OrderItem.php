<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /**
     * L'OrderItem appartient à une commande
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * L'OrderItem appartient à un produit
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
