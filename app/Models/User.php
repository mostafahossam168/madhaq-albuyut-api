<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'image',
        'password',
        'code',
        'expire_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function rates()
    {
        return $this->belongsToMany(Product::class, 'ratings')->withPivot('rate', 'notes');
    }

    public function cart()
    {
        return $this->belongsToMany(Product::class, 'carts')->withPivot('qty', 'price');
    }


    public function favorite()
    {
        return $this->belongsToMany(Product::class, 'favorites');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => asset($value),
        );
    }

    public function chats()
    {
        return $this->hasMany(Chat::class, 'created_by');
    }


    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class);
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}