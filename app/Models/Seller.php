<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable = ['name', 'position']; // 'bio' → 'position'

    // A seller has many products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
