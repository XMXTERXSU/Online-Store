<?php

namespace App\Models;

use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone_number',
        'session_id', 'user_id'
    ];

    public function cart(){
        $this->belongsTo(Cart::class);
    }

    public static function get(){
        if (Auth::check()) {
            return self::where(['user_id' => Auth::id()])->get();
        } else {
            return self::where(['session_id' => session()->getId()])->get();
        }
    }
}
