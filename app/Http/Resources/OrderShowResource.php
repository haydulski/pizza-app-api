<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Vinkla\Hashids\Facades\Hashids;

class OrderShowResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => Hashids::connection('order')->encode($this->id),
            'status' => $this->status,
            'total_price' => $this->total_price,
            'orderedItems' => OrderedItemResource::collection($this->orderedItems),
        ];
    }
}
