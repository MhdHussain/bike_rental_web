<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Bike extends Model implements HasMedia
{
    use HasMediaTrait;

    public $table = 'bikes';

    protected $appends = [
        'photos',
    ];

    const REAR_LIGHT_RADIO = [
        'Yes' => 'Yes',
        'No'  => 'No',
    ];

    const FRONT_LIGHT_RADIO = [
        'Yes' => 'Yes',
        'No'  => 'No',
    ];

    const SPEED_SENSOR_RADIO = [
        'Yes' => 'Yes',
        'No'  => 'No',
    ];

    const STATUS_SELECT = [
        'Pending'  => 'Pending Approval',
        'Approved' => 'Approved',
        'Rejected' => 'Rejected',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'brand',
        'description',
        'owner_id',
        'quantity',
        'price_per_day',
        'height',
        'front_light',
        'rear_light',
        'speed_sensor',
        'status',
        'latitude',
        'longitude',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function bikeRentals()
    {
        return $this->hasMany(Rental::class, 'bike_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function getPhotosAttribute()
    {
        $files = $this->getMedia('photos');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function scopeCloseTo($query , $lat , $lng)
    {
        // works for mysql not for postgres
        // return $query->where('quantity' , '>' , 0)->with(['owner'])->whereRaw("
        // ST_Distance_Sphere(
        //         point(bikes.longitude,bikes.latitude),
        //         point(?, ?)
        //     ) * 0.001 < 1000
        // ", [
        //     $lng,
        //     $lat,
        // ])->where('status' , 'Approved')->get();

        // this code works for postgres
        $gr_circle_radius = 6371;
        $max_distance = 500;

        $distance_select = sprintf(
                                      "
                                      ( %d * acos( cos( radians(%s) ) " .
                                              " * cos( radians( bikes.latitude ) ) " .
                                              " * cos( radians( bikes.longitude ) - radians(%s) ) " .
                                              " + sin( radians(%s) ) * sin( radians( bikes.latitude ) ) " .
                                          " ) " .
                                      ")
                                       ",
                                      $gr_circle_radius,
                                      $lat,
                                      $lng,
                                      $lat
                                     );
        return $query->where('quantity' , '>' , 0)->with(['owner'])->
        having(DB::raw($distance_select) , '<=' , $max_distance)
        ->where('status' , 'Approved')
        ->groupBy('bikes.id')
        ->get();
    }
}
