<?php

namespace App\Http\Resources;

use App\Http\Resources\Admin\BikeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientRentalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'period' => $this->period_in_days,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
            'bike' => new BikeResource($this->bike)
        ];
    }
}
