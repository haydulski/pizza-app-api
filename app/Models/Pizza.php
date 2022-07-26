<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'slug',
        'img', 'thumbnail', 'dough',
        'ingredient_1', 'ingredient_2',
        'ingredient_3', 'ingredient_4',
        'ingredient_5', 'ingredient_6',
    ];
}
