<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'name', 'category_id', 'price', 'description'
    ];




    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function rates()
    {
        return $this->belongsToMany(User::class, 'ratings')->withPivot('rate', 'notes');
    }
    public function cart()
    {
        return $this->belongsToMany(User::class, 'carts')->withPivot('qty', 'price');
    }

    public function favorite()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')->withPivot('qty', 'price');
    }



    public function images()
    {
        return $this->morphMany(Images::class, 'imageable');
    }
    public function image()
    {
        return $this->morphOne(Images::class, 'imageable');
    }
}
