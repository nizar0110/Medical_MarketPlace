<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Une catégorie a plusieurs produits
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
