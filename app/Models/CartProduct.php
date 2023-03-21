<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;

    public function products(){
        $this->belongsToMany(Product::class);
    }

    public function carts(){
        $this->belongsToMany(Cart::class);
    }
}
