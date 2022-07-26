<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Vinkla\Hashids\Facades\Hashids;

class VendorOrderResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => Hashids::connection('order')->encode($this->id),
            'status' => $this->status,
            'total_price' => $this->total_price,
        ];
    }
}
