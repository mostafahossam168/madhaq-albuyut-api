<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image', 'description', 'status'];


    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function scopeActive()
    {
        return $this->where('status', 1);
    }
}