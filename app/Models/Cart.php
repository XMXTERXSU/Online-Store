<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id', 'product_id',
        'quantity', 'price',
    ];


    public static function get()
    {
        return self::where(['session_id' => session()->getId()])->get();
    }

    public static function add($product_id)
    {
        $product = Product::findOrFail($product_id);

        if ($cart = self::where(['session_id' => session()->getId(), 'product_id' => $product_id])->first()) {
            $cart->quantity++;
            $cart->save();
            return $cart;
        } else {
            $cart = self::create([
                'session_id' => session()->getId(),
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
                'user_id' => session('user_id') ?? ''
            ]);

            return $cart;
        }
    }

    public static function remove($id)
    {
        return self::destroy($id);
    }

    public static function quantity($id, $quantity)
    {
        if ($quantity <= 0) {
            return self::remove($id);
        }

        $cart = self::findOrFail($id);

        $cart->quantity = $quantity;
        $cart->save();

        return $cart;
    }


    public function products()
    {
        $this->belongsToMany(Product::class);
    }
}
