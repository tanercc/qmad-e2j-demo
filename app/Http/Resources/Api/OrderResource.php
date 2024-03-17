<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "orderID" => $this->orderID,
            "customerID" => $this->customerID,
            "orderDate" => $this->orderDate,
            "shippedDate" => $this->shippedDate,
            "freight" => $this->freight,
            "shipName" => $this->shipName,
            "shipAddress" => $this->shipAddress,
            "shipCity" => $this->shipCity,
            "shipRegion" => $this->shipRegion,
            "shipCountry" => $this->shipCountry,
            "status_id" => $this->status_id,
        ];
    }
}
