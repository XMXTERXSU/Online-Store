<?php

namespace App\Models;

use App\Models\Category;
use App\Models\CartProduct;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    protected $guarded = false;
    protected $table = 'products';

    use HasFactory, SoftDeletes, Filterable;

    public function categories()
    {
        $this->belongsTo(Category::class);
    }

    public function cart(){
        $this->belongsToMany(CartProduct::class)->withPivot('quantity');
    }
}
