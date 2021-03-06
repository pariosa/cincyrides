<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('event_name');
            $table->string('category_id');
            $table->string('description');
            $table->string('strava_link')->default(null);;
            $table->string('location');
            $table->integer('approved');
            $table->string('image');
            $table->integer('event_owner_id')->unsigned(); 
            $table->date('date'); 

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
        Schema::dropIfExists('events');
    }
}
