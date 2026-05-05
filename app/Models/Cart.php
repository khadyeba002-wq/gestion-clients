<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'product_id', 'quantity'];

    // relation avec produit
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // relation avec utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
