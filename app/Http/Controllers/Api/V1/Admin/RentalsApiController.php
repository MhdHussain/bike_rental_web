<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRentalRequest;
use App\Http\Requests\UpdateRentalRequest;
use App\Http\Resources\Admin\RentalResource;
use App\Models\Rental;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RentalsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rental_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RentalResource(Rental::with(['bike', 'client'])->get());
    }

    public function store(StoreRentalRequest $request)
    {
        $rental = Rental::create($request->all());

        return (new RentalResource($rental))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Rental $rental)
    {
        abort_if(Gate::denies('rental_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RentalResource($rental->load(['bike', 'client']));
    }

    public function update(UpdateRentalRequest $request, Rental $rental)
    {
        $rental->update($request->all());

        return (new RentalResource($rental))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Rental $rental)
    {
        abort_if(Gate::denies('rental_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rental->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
