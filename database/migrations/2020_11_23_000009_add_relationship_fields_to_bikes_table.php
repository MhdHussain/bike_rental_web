<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBikesTable extends Migration
{
    public function up()
    {
        Schema::table('bikes', function (Blueprint $table) {
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id', 'owner_fk_2641690')->references('id')->on('users');
        });
    }
}
