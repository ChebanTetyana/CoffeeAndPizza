<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Product
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'count', 'price', 'product_type','name', 'user_id', 'size', 'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
