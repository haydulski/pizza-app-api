<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Vinkla\Hashids\Facades\Hashids;

class VendorResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => Hashids::encode($this->id),
            'name' => $this->id,
            'surname' => $this->surname,
            'email' => $this->email,
            'street' => $this->street,
            'phone' => $this->phone,
            'house_number' => $this->house_number,
            'city' => $this->city,
            'post_code' => $this->post_code,
            'orders' => VendorOrderResource::collection($this->orders),
        ];
    }
}
