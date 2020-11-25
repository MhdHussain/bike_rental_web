<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBikeRequest;
use App\Http\Requests\UpdateBikeRequest;
use App\Http\Resources\Admin\BikeResource;
use App\Models\Bike;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BikesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('bike_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BikeResource(Bike::with(['owner'])->get());
    }

    public function store(StoreBikeRequest $request)
    {
        $bike = Bike::create($request->all());

        if ($request->input('photos', false)) {
            $bike->addMedia(storage_path('tmp/uploads/' . $request->input('photos')))->toMediaCollection('photos');
        }

        return (new BikeResource($bike))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Bike $bike)
    {
        abort_if(Gate::denies('bike_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BikeResource($bike->load(['owner']));
    }

    public function update(UpdateBikeRequest $request, Bike $bike)
    {
        $bike->update($request->all());

        if ($request->input('photos', false)) {
            if (!$bike->photos || $request->input('photos') !== $bike->photos->file_name) {
                if ($bike->photos) {
                    $bike->photos->delete();
                }

                $bike->addMedia(storage_path('tmp/uploads/' . $request->input('photos')))->toMediaCollection('photos');
            }
        } elseif ($bike->photos) {
            $bike->photos->delete();
        }

        return (new BikeResource($bike))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Bike $bike)
    {
        abort_if(Gate::denies('bike_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bike->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
