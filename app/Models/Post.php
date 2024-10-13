<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    // Menentukan field yang boleh diisi melalui mass assignment
    protected $fillable = [
        'user_id', 
        'produk_name',  
        'descripsi',     
        'price',        
        'stock',         
        'path',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}