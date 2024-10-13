<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',   
        'email',   
        'password', 
         'role',
    ];

    protected $hidden = [
        'password', // Sembunyikan password dari hasil query
        'remember_token',
    ];

    // Relasi ke Post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

     public function isAdmin()
    {
        return $this->role === 'admin';
    }

}