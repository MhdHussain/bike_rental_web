@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.rental.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.rentals.update", [$rental->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="bike_id">{{ trans('cruds.rental.fields.bike') }}</label>
                <select class="form-control select2 {{ $errors->has('bike') ? 'is-invalid' : '' }}" name="bike_id" id="bike_id" required>
                    @foreach($bikes as $id => $bike)
                        <option value="{{ $id }}" {{ (old('bike_id') ? old('bike_id') : $rental->bike->id ?? '') == $id ? 'selected' : '' }}>{{ $bike }}</option>
                    @endforeach
                </select>
                @if($errors->has('bike'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bike') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rental.fields.bike_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.rental.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                    @foreach($clients as $id => $client)
                        <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $rental->client->id ?? '') == $id ? 'selected' : '' }}>{{ $client }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rental.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quantity">{{ trans('cruds.rental.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', $rental->quantity) }}" step="1">
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rental.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="period_in_days">{{ trans('cruds.rental.fields.period_in_days') }}</label>
                <input class="form-control {{ $errors->has('period_in_days') ? 'is-invalid' : '' }}" type="text" name="period_in_days" id="period_in_days" value="{{ old('period_in_days', $rental->period_in_days) }}">
                @if($errors->has('period_in_days'))
                    <div class="invalid-feedback">
                        {{ $errors->first('period_in_days') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rental.fields.period_in_days_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount">{{ trans('cruds.rental.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $rental->amount) }}" step="0.01">
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rental.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.rental.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Rental::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $rental->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rental.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection