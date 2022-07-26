<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'is_custom', 'pizza_id',
        'amount', 'price', 'dough_size', 'double_cheese',
        'dough', 'ingredient_1', 'ingredient_2',
        'ingredient_3', 'ingredient_4',
        'ingredient_5', 'ingredient_6',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
