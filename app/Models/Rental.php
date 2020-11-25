<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Rental extends Model
{
    public $table = 'rentals';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    const STATUS_SELECT = [
        'Pending'  => 'Pending',
        'Rented'   => 'Rented',
        'Returned' => 'Returned',
    ];

    protected $fillable = [
        'bike_id',
        'client_id',
        'quantity',
        'period_in_days',
        'amount',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function bike()
    {
        return $this->belongsTo(Bike::class, 'bike_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
