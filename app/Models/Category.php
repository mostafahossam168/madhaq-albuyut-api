<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'family_id'
    ];

    public function products()
    {
        return  $this->hasMany(Product::class);
    }
    public function family()
    {
        return  $this->belongsTo(Family::class);
    }
}
