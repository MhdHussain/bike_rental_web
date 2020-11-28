<?php

namespace App\Providers;

use App\Http\Repositories\BikesAdmin\BikesAdminSqlRepository;
use App\Http\Repositories\BikesAdmin\IBikesAdminRepository;
use App\Http\Repositories\Mobile\Auth\IJWTAuth;
use App\Http\Repositories\Mobile\Auth\JWTAuth;
use App\Http\Repositories\Mobile\Client\ClientBikeSqlRepository;
use App\Http\Repositories\Mobile\Client\IClientBikeRepository;
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

        app()->singleton(IJWTAuth::class , JWTAuth::class);
        app()->singleton(IClientBikeRepository::class , ClientBikeSqlRepository::class);

    }
}
