<?php

namespace App\Http\Requests;

use App\Models\Bike;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBikeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bike_edit');
    }

    public function rules()
    {
        return [
            'brand'         => [
                'string',
                'required',
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
