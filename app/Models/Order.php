<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'date',
        'total_amount',
        'status'
    ];


    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
