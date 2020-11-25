<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRentalsTable extends Migration
{
    public function up()
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->unsignedBigInteger('bike_id');
            $table->foreign('bike_id', 'bike_fk_2641714')->references('id')->on('bikes');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id', 'client_fk_2641715')->references('id')->on('users');
        });
    }
}
