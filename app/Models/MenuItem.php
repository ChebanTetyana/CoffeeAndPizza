<?php

namespace App\Models;

use App\Enums\ProductType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Product
{
    use HasFactory;

    protected $fillable = [
        'description'
    ];

//    protected $attributes = [
//        'product_type' => ProductType::PIZZA,
//    ];
}
