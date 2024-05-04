<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'image'
    ];
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => asset($value),
        );
    }
}
