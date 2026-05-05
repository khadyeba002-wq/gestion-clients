<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];

    // 🔗 Relation vers produit
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // 🔗 Relation vers commande
    public function order()
    {
        return $this->belongsTo(Order::class);
    }


}
