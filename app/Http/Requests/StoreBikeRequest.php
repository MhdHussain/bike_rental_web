<?php

namespace App\Http\Requests;

use App\Models\Bike;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBikeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bike_create');
    }

    public function rules()
    {
        return [
            'brand'         => [
                'string',
                'required',
            ],
            'owner_id'      => [
                'required',
                'integer',
            ],
            'description'   => [
                'required',
            ],
            'quantity'      => [
                'nullable',
                'integer',
                'min:1',
                'max:100',
            ],
            'price_per_day' => [
                'required',
            ],
            'height'        => [
                'numeric',
            ],
            'status'        => [
                'required',
            ],
            'latitude'      => [
                'numeric',
                'required',
            ],
            'longitude'     => [
                'numeric',
                'required',
            ],
        ];
    }
}
