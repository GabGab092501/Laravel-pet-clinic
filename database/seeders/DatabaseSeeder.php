<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\HoomansSeeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\ServiceSeeder;

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
           HoomansSeeder::class,
            CustomerSeeder::class,
            ServiceSeeder::class
        ]);
    }
}
