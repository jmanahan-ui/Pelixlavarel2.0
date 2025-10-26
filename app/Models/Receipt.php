<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    // ✅ include seller_id in fillable
    protected $fillable = [
        'product_id',
        'seller_id',
        'quantity',
        'total',
        'payment',
        'change',
    ];

    // ✅ link each receipt to its product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // ✅ link each receipt to its seller
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
