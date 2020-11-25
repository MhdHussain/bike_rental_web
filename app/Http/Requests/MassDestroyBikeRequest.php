<?php

namespace App\Http\Requests;

use App\Models\Bike;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBikeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('bike_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bikes,id',
        ];
    }
}
