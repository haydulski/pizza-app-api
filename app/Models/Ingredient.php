<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ingredient extends Model
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $table = 'ingredients';

    protected $fillable = [
        'name', 'cost', 'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(IngredientCategory::class);
    }
}
