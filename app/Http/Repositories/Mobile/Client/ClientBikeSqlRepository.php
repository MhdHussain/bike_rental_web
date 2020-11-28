<?php


namespace App\Http\Repositories\Mobile\Client;


use App\Http\Repositories\Mobile\Auth\IJWTAuth;
use App\Models\Bike;
use App\Models\Rental;
use Symfony\Component\HttpFoundation\Response;

class ClientBikeSqlRepository implements IClientBikeRepository
{

    /**
     * @var Bike
     */
    private $bike;
    /**
     * @var IJWTAuth
     */
    private $auth;
    /**
     * @var Rental
     */
    private $rental;

    public function __construct(Bike $bike , Rental $rental , IJWTAuth $auth)
    {
        $this->bike = $bike;
        $this->auth = $auth;
        $this->rental = $rental;
    }

    public function getNearbyBikes($latitude, $longitude)
    {
        $this->checkAuth();

        return $this->bike->closeTo($latitude , $longitude);


    }

    public function getBikeById($bike)
    {
        $this->checkAuth();

        return $bike;
    }

    public function listRentedBikes()
    {
        $this->checkAuth();

        $rentedBikes = $this->rental->where('client_id' , auth()->user()->id)
            ->with(['bike' => function($q){
                $q->with('owner');
            }])
            ->get();

        return $rentedBikes;
    }

    public function rentBike($bike, $count , $period)
    {
        $this->checkAuth();
        abort_if($count > $bike->quantity ,
            Response::HTTP_FORBIDDEN , 'Amount of bikes required cannot be more than the amount of bikes available');
        $payload = [
          'bike_id' => $bike->id,
          'client_id' => auth()->user()->id,
          'quantity' => $count,
          'period' => $period,
          'amount' => $bike->price_per_day * $count * $period,
          'status' => 'Pending'
        ];



        $this->rental->create($payload);

        $bike->update([
            'quantity' => $bike->quantity - $count
        ]);
    }

    public function returnBike($rental, $count)
    {
        $this->checkAuth();
       // update rental status to returned
        $rental->update([
           'status' => Rental::STATUS_SELECT['Returned']
        ]);
       // change the bike quantity number
        $rental->bike->update([
            'quantity' => $rental->bike->quantity + $count
        ]);
    }

    private function checkAuth()
    {
        $user = auth()->user();
        $this->auth->checkUserStatus($user);

    }
}
