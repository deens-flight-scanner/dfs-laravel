<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('favorites')->truncate();
        $faker = \Faker\Factory::create();
        for($i = 0; $i < 50; $i++){
            DB::table('favorites')->insert([
                'user_id' => rand(1,3),
                'departure_airport' => Str::random(3),
                'departure_city' => $faker->city,
                'departure_date' => $faker->date,
                'arrival_airport' => Str::random(3),
                'arrival_city' => $faker->city,
                'arrival_date' => $faker->date,
                'price' => rand(0,1000),
                'airline' => '',
                'airline_code' => '',
            ]);
        }
    }
}
