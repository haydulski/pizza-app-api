<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Vinkla\Hashids\Facades\Hashids;

class PizzasResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => Hashids::encode($this->id),
            'name' => $this->name,
            'slug' => $this->slug,
            'img' => Storage::url($this->img),
            'thumbnail' => Storage::url($this->thumbnail),
            'price' => $this->price,
            'dough' => $this->dough,
            'ingredient_1' => $this->ingredient_1,
            'ingredient_2' => $this->ingredient_2,
            'ingredient_3' => $this->ingredient_3,
            'ingredient_4' => $this->ingredient_4,
            'ingredient_5' => $this->ingredient_5,
            'ingredient_6' => $this->ingredient_6,
        ];
    }
}
