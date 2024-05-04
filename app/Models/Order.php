<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'payment_id', 'user_id', 'subtotal', 'discount', 'total', 'status', 'phone', 'address',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot('qty', 'price');
    }
    public function uers()
    {
        return $this->belongs(User::class);
    }
}
