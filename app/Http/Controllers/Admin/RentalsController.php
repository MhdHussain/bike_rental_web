<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\RentalAdmin\IRentalRepository;
use App\Http\Requests\MassDestroyRentalRequest;
use App\Http\Requests\StoreRentalRequest;
use App\Http\Requests\UpdateRentalRequest;
use App\Models\Bike;
use App\Models\Rental;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RentalsController extends Controller
{

    /**
     * @var IRentalRepository
     */
    private $repository;

    public function __construct(IRentalRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {

       return $this->repository->allAjax($request);
    }

    public function create()
    {
       return $this->repository->showCreateView();
    }

    public function store(StoreRentalRequest $request)
    {
        return $this->repository->storeRental($request->all());
    }

    public function edit(Rental $rental)
    {
        return $this->repository->showUpdateView($rental);
    }

    public function update(UpdateRentalRequest $request, Rental $rental)
    {
        return $this->repository->updateRental($rental , $request->all());

    }

    public function show(Rental $rental)
    {
        return $this->repository->getRental($rental);
    }

    public function destroy(Rental $rental)
    {
        return $this->repository->deleteRental($rental);
    }

    public function massDestroy(MassDestroyRentalRequest $request)
    {
        return $this->repository->deleteRentals(request('ids'));

    }
}
