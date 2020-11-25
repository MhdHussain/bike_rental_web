<?php


namespace App\Http\Repositories\BikesAdmin;


use App\Models\Bike;

interface IBikesAdminRepository
{
    public function allAjax($request);
    public function getBike(Bike $bike);
    public function showCreateView();

    public function storeBike($values , $photos);

    public function showUpdateView(Bike $bike);

    public function updateBike(Bike $bike , $values , $photos);

    public function deleteBike(Bike $bike);

    public function deleteBikes($bikes);

}
