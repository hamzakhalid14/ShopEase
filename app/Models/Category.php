<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Category.php
class Category extends Model
{
    protected $fillable = ['name', 'image_url'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

