<?php

namespace App\Models;

use App\Models\OrderProduct;
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
}
