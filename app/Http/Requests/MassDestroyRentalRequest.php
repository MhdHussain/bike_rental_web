<?php

namespace App\Http\Requests;

use App\Models\Rental;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRentalRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('rental_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:rentals,id',
        ];
    }
}
