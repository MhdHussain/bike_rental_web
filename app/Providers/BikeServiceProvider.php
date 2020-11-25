<?php

namespace App\Providers;

use App\Http\Repositories\BikesAdmin\BikesAdminSqlRepository;
use App\Http\Repositories\BikesAdmin\IBikesAdminRepository;
use App\Http\Repositories\RentalAdmin\IRentalRepository;
use App\Http\Repositories\RentalAdmin\RentalSqlRepository;
use Illuminate\Support\ServiceProvider;

class BikeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        app()->singleton(IBikesAdminRepository::class ,
            BikesAdminSqlRepository::class);
        app()->singleton(IRentalRepository::class ,
        RentalSqlRepository::class);

    }
}
