<?php


namespace App\Http\Repositories\Mobile\Client;


interface IClientBikeRepository
{

    public function getNearbyBikes($latitude , $longitude);

    public function getBikeById($bike);

    public function listRentedBikes();

    public function rentBike($bike , $count , $period);

    public function returnBike($rental , $count);
}
