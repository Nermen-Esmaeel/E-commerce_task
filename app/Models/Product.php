<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'price',
        'quantity',
        'image',
    ];


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

     //morphMany between posts and images
     public function images()
     {
         return $this->morphMany(Image::class, 'imageable');
     }


     public function cart(): BelongsTo
     {
         return $this->belongsTo(Cart::class, 'product_id', 'id');
     }

}
