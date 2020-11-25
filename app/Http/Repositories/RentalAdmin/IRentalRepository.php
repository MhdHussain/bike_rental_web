<?php


namespace App\Http\Repositories\RentalAdmin;


use App\Models\Rental;

interface IRentalRepository
{
    public function allAjax($request);
    public function getRental(Rental $rental);
    public function showCreateView();

    public function storeRental($values);

    public function showUpdateView(Rental $rental);

    public function updateRental(Rental $rental , $values );

    public function deleteRental(Rental $rental);

    public function deleteRentals($rentals);

}
