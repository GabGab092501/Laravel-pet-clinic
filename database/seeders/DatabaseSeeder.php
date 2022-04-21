<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PersonnelSeeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\AnimalSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PersonnelSeeder::class,
            CustomerSeeder::class,
            ServiceSeeder::class,
            AnimalSeeder::class
        ]);
    }
}
