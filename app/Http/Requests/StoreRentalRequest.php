<?php

namespace App\Http\Requests;

use App\Models\Rental;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRentalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('rental_create');
    }

    public function rules()
    {
        return [
            'bike_id'        => [
                'required',
                'integer',
            ],
            'client_id'      => [
                'required',
                'integer',
            ],
            'quantity'       => [
                'nullable',
                'integer',
                'min:1',
                'max:100',
            ],
            'period_in_days' => [
                'string',
                'nullable',
            ],
            'status'         => [
                'required',
            ],
        ];
    }
}
