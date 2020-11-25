<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Repositories\BikesAdmin\IBikesAdminRepository;
use App\Http\Requests\MassDestroyBikeRequest;
use App\Http\Requests\StoreBikeRequest;
use App\Http\Requests\UpdateBikeRequest;
use App\Models\Bike;
use Gate;
use Illuminate\Http\Request;


class BikesController extends Controller
{
    use MediaUploadingTrait;

    /**
     * @var IBikesAdminRepository
     */
    private $repository;

    public function __construct(IBikesAdminRepository $repository)
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

    public function store(StoreBikeRequest $request)
    {
        return $this->repository->storeBike($request->all() ,
            $request->input('photos', []));
    }

    public function edit(Bike $bike)
    {
       return $this->repository->showUpdateView($bike);
    }

    public function update(UpdateBikeRequest $request, Bike $bike)
    {

        return $this->repository->updateBike($bike ,
            $request->all() ,
            $request->input('photos', []));

    }

    public function show(Bike $bike)
    {
        return $this->repository->getBike($bike);
    }

    public function destroy(Bike $bike)
    {
        return $this->repository->deleteBike($bike);
    }

    public function massDestroy(MassDestroyBikeRequest $request)
    {
       return $this->repository->deleteBikes(request('ids'));
    }


}
