<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\PhotosResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BikeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'price' => $this->price_per_day,
            'owner' => $this->owner->name,
            'brand' => $this->brand,
            'description' => $this->description,
            'status' => $this->status,
            'quantity' => $this->quantity,
            'height' => $this->height,
            'front_light' => $this->front_light,
            'rear_light' => $this->rear_light,
            'speed_sensor' => $this->speed_sensor,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'photos' => $this->photos
        ];
    }
}
