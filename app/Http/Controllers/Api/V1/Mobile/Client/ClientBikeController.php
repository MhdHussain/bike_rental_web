<?php


namespace App\Http\Controllers\Api\V1\Mobile\Client;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Mobile\Client\IClientBikeRepository;
use App\Models\Bike;
use App\Models\Rental;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientBikeController extends Controller
{

    /**
     * @var IClientBikeRepository
     */
    private $repository;

    public function __construct(IClientBikeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getNearbyBikes(Request $request)
    {
        $bikes =  $this->repository->getNearbyBikes($request->get('latitude') ,
                $request->get('longitude')
                );

        return response()->json($bikes , Response::HTTP_OK);
    }

    public function getBike(Bike $bike)
    {
        return response()->json($this->repository->getBikeById($bike) , Response::HTTP_OK);
    }

    public function getRentedBikes(Request $request)
    {
        return response()->json($this->repository->listRentedBikes() , Response::HTTP_OK);
    }

    public function rentBike(Request $request , Bike $bike)
    {
        $this->repository->rentBike($bike , $request->get('count') , $request->get('period'));

        return response()->json(null , Response::HTTP_CREATED);
    }

    public function return(Request $request , Rental $rental)
    {
        $this->repository->returnBike($rental , $request->get('count'));

        return response()->json(null , Response::HTTP_ACCEPTED);
    }

}
