<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = false;
    protected $table = 'categories';

    use HasFactory;

    public function products()
    {
        $this->hasMany(Product::class);
    }
}
