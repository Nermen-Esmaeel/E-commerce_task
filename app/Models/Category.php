<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

     //morphMany between posts and images
     public function images()
     {
         return $this->morphMany(Image::class, 'imageable');
     }
}
