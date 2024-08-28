<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'admin_id',
        'message',
        'sender',
    ];

    // العلاقة بين الرسالة والمستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // العلاقة بين الرسالة والمسؤول
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}