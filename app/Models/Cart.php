<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'product_id',
        'user_id',
        'quantity',
        'price',
    ];


    public static function get()
    {
        if (Auth::check()) {
            return self::where(['user_id' => Auth::id()])->get();
        } else {
            return self::where(['session_id' => session()->getId()])->get();
        }
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
                'user_id' => Auth::id()
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
