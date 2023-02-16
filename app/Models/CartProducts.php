<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartProduct extends Model
{
    use HasFactory;
    protected $table = 'cart_product';
    protected $guarded = false;

    public function products(){
        $this->belongsToMany(Product::class);
    }
    public function carts(){
        $this->belongsToMany(Cart::class);
    }
}
