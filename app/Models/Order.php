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
        'cart_id',
    ];

    public function products(){
        $this->hasMany(OrderProduct::class);
    }
}
