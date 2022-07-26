<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderedItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'is_custom' => $this->is_custom,
            'amount' => $this->amount,
            'price' => $this->price,
            'dough' => $this->dough,
            'dough_size' => $this->dough_size,
            'double_cheese' => $this->double_cheese,
            'ingredient_1' => $this->ingredient_1,
            'ingredient_2' => $this->ingredient_2,
            'ingredient_3' => $this->ingredient_3,
            'ingredient_4' => $this->ingredient_4,
            'ingredient_5' => $this->ingredient_5,
            'ingredient_6' => $this->ingredient_6,
        ];
    }
}
