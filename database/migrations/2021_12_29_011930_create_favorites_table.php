<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->text("departure_airport");
            $table->text("departure_city");
            $table->text("departure_date");
            $table->text("arrival_airport");
            $table->text("arrival_city");
            $table->text("arrival_date");
            $table->double("price");
            $table->text("airline")->nullable();
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
        Schema::dropIfExists('favorites');
    }
}
