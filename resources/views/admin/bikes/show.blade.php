@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bike.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bikes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bike.fields.id') }}
                        </th>
                        <td>
                            {{ $bike->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bike.fields.brand') }}
                        </th>
                        <td>
                            {{ $bike->brand }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bike.fields.owner') }}
                        </th>
                        <td>
                            {{ $bike->owner->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bike.fields.description') }}
                        </th>
                        <td>
                            {{ $bike->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bike.fields.quantity') }}
                        </th>
                        <td>
                            {{ $bike->quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bike.fields.price_per_day') }}
                        </th>
                        <td>
                            {{ $bike->price_per_day }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bike.fields.height') }}
                        </th>
                        <td>
                            {{ $bike->height }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bike.fields.front_light') }}
                        </th>
                        <td>
                            {{ App\Models\Bike::FRONT_LIGHT_RADIO[$bike->front_light] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bike.fields.rear_light') }}
                        </th>
                        <td>
                            {{ App\Models\Bike::REAR_LIGHT_RADIO[$bike->rear_light] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bike.fields.speed_sensor') }}
                        </th>
                        <td>
                            {{ App\Models\Bike::SPEED_SENSOR_RADIO[$bike->speed_sensor] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bike.fields.photos') }}
                        </th>
                        <td>
                            @foreach($bike->photos as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bike.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Bike::STATUS_SELECT[$bike->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bike.fields.latitude') }}
                        </th>
                        <td>
                            {{ $bike->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bike.fields.longitude') }}
                        </th>
                        <td>
                            {{ $bike->longitude }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bikes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#bike_rentals" role="tab" data-toggle="tab">
                {{ trans('cruds.rental.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="bike_rentals">
            @includeIf('admin.bikes.relationships.bikeRentals', ['rentals' => $bike->bikeRentals])
        </div>
    </div>
</div>

@endsection