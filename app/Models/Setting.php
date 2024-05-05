<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo',
        'text1',
        'image1',
        'text2',
        'image2',
        'text3',
        'image3',
        'f_link',
        'i_link',
        't_link',
        'email',
        'phone',
        'conditions',
        'policy',
        'policy',
    ];

    protected function image1(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => asset($value),
        );
    }
    protected function image2(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => asset($value),
        );
    }
    protected function image3(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => asset($value),
        );
    }
    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => asset($value),
        );
    }
}
