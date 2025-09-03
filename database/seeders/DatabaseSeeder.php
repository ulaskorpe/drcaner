<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\StatesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\App\Models\User::factory(100)->create();

        $this->call(CountriesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        // $this->call(CitiesTableChunkOneSeeder::class);
        // $this->call(CitiesTableChunkTwoSeeder::class);
        // $this->call(CitiesTableChunkThreeSeeder::class);
        // $this->call(CitiesTableChunkFourSeeder::class);
        // $this->call(CitiesTableChunkFiveSeeder::class);

    }
}
