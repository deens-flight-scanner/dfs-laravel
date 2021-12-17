<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->text("code");
            $table->double("lat");
            $table->double("lon");
            $table->text("name");
            $table->text("city");
            $table->text("state")->nullable();
            $table->text("country");
            $table->integer("woeid");
            $table->text("tz");
            $table->text("phone");
            $table->text("type");
            $table->text("email");
            $table->text("url");
            $table->integer("runway_length")->nullable();
            $table->integer("elev")->nullable();
            $table->text("icao");
            $table->integer("direct_flights");
            $table->integer("carriers");
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
        Schema::dropIfExists('airports');
    }
}
