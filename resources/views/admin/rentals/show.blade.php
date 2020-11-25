@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.rental.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.rentals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.rental.fields.id') }}
                        </th>
                        <td>
                            {{ $rental->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rental.fields.bike') }}
                        </th>
                        <td>
                            {{ $rental->bike->brand ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rental.fields.client') }}
                        </th>
                        <td>
                            {{ $rental->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rental.fields.quantity') }}
                        </th>
                        <td>
                            {{ $rental->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rental.fields.period_in_days') }}
                        </th>
                        <td>
                            {{ $rental->period_in_days }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rental.fields.amount') }}
                        </th>
                        <td>
                            {{ $rental->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rental.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Rental::STATUS_SELECT[$rental->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.rentals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection