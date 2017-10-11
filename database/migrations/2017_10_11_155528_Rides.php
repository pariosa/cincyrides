<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rides extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('rides', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('category');
            $table->string('description');
            $table->string('strava_link')->default(null);
            $table->string('location');
            $table->string('image');
            $table->integer('event_owner_id')->unsigned(); 
            $table->date('date'); 
            $table->integer('approved')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('rides');
    }
}
