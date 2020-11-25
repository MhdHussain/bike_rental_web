@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.bike.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bikes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="brand">{{ trans('cruds.bike.fields.brand') }}</label>
                <input class="form-control {{ $errors->has('brand') ? 'is-invalid' : '' }}" type="text" name="brand" id="brand" value="{{ old('brand', '') }}" required>
                @if($errors->has('brand'))
                    <div class="invalid-feedback">
                        {{ $errors->first('brand') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bike.fields.brand_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="owner_id">{{ trans('cruds.bike.fields.owner') }}</label>
                <select class="form-control select2 {{ $errors->has('owner') ? 'is-invalid' : '' }}" name="owner_id" id="owner_id" required>
                    @foreach($owners as $id => $owner)
                        <option value="{{ $id }}" {{ old('owner_id') == $id ? 'selected' : '' }}>{{ $owner }}</option>
                    @endforeach
                </select>
                @if($errors->has('owner'))
                    <div class="invalid-feedback">
                        {{ $errors->first('owner') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bike.fields.owner_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.bike.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bike.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quantity">{{ trans('cruds.bike.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '1') }}" step="1">
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bike.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price_per_day">{{ trans('cruds.bike.fields.price_per_day') }}</label>
                <input class="form-control {{ $errors->has('price_per_day') ? 'is-invalid' : '' }}" type="number" name="price_per_day" id="price_per_day" value="{{ old('price_per_day', '') }}" step="0.01" required>
                @if($errors->has('price_per_day'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price_per_day') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bike.fields.price_per_day_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="height">{{ trans('cruds.bike.fields.height') }}</label>
                <input class="form-control {{ $errors->has('height') ? 'is-invalid' : '' }}" type="number" name="height" id="height" value="{{ old('height', '') }}" step="0.01">
                @if($errors->has('height'))
                    <div class="invalid-feedback">
                        {{ $errors->first('height') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bike.fields.height_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.bike.fields.front_light') }}</label>
                @foreach(App\Models\Bike::FRONT_LIGHT_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('front_light') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="front_light_{{ $key }}" name="front_light" value="{{ $key }}" {{ old('front_light', 'Yes') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="front_light_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('front_light'))
                    <div class="invalid-feedback">
                        {{ $errors->first('front_light') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bike.fields.front_light_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.bike.fields.rear_light') }}</label>
                @foreach(App\Models\Bike::REAR_LIGHT_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('rear_light') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="rear_light_{{ $key }}" name="rear_light" value="{{ $key }}" {{ old('rear_light', 'Yes') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="rear_light_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('rear_light'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rear_light') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bike.fields.rear_light_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.bike.fields.speed_sensor') }}</label>
                @foreach(App\Models\Bike::SPEED_SENSOR_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('speed_sensor') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="speed_sensor_{{ $key }}" name="speed_sensor" value="{{ $key }}" {{ old('speed_sensor', 'Yes') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="speed_sensor_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('speed_sensor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('speed_sensor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bike.fields.speed_sensor_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photos">{{ trans('cruds.bike.fields.photos') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photos') ? 'is-invalid' : '' }}" id="photos-dropzone">
                </div>
                @if($errors->has('photos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bike.fields.photos_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.bike.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Bike::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'Pending') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bike.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="latitude">{{ trans('cruds.bike.fields.latitude') }}</label>
                <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="number" name="latitude" id="latitude" value="{{ old('latitude', '') }}" step="0.01" required>
                @if($errors->has('latitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('latitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bike.fields.latitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="longitude">{{ trans('cruds.bike.fields.longitude') }}</label>
                <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="number" name="longitude" id="longitude" value="{{ old('longitude', '') }}" step="0.01" required>
                @if($errors->has('longitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('longitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bike.fields.longitude_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedPhotosMap = {}
Dropzone.options.photosDropzone = {
    url: '{{ route('admin.bikes.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
      uploadedPhotosMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotosMap[file.name]
      }
      $('form').find('input[name="photos[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($bike) && $bike->photos)
      var files = {!! json_encode($bike->photos) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection