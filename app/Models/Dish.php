<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;



    protected $fillable = ([
        'name',
        'slug',
        'description',
        'price',
        'is_visible',
        'image',
    ]);

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }
    public function orders(){
        return $this->belongsToMany(Order::class);
    }
}
