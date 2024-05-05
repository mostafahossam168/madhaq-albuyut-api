<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'payment_id', 'user_id', 'subtotal', 'discount', 'total', 'status', 'phone', 'address',
    ];


    protected $casts = [
        'status' => Status::class,
        'order' => Status::class,
    ];


    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot('qty', 'price');
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
