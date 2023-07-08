<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = ['name', 'lastname', 'username', 'email', 'password'];

    protected $hidden = [
        'password'
    ];

    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->lastname}";
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }
}
