<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Les attributs qui peuvent être assignés en masse.
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Une catégorie a plusieurs produits
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
