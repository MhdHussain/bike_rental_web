<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikesTable extends Migration
{
    public function up()
    {
        Schema::create('bikes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('price_per_day', 15, 2);
            $table->float('height', 15, 2)->nullable();
            $table->string('front_light')->nullable();
            $table->string('rear_light')->nullable();
            $table->string('speed_sensor')->nullable();
            $table->integer('quantity')->nullable();
            $table->longText('description');
            $table->string('brand');
            $table->string('status');
            $table->float('latitude', 15, 10);
            $table->float('longitude', 15, 10);
            $table->timestamps();
        });
    }
}
