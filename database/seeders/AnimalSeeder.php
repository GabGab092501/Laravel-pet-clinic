<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;
use Illuminate\Support\Facades\DB;
use App\Models\Animal;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $customer = DB::table('customers')->pluck('id');
        foreach (range(1, 10) as $index) {
            Animal::create([
                'customer_id' => $faker->randomElement($customer),
                'animal_name' => $faker->name(),
                'age' => $faker->randomDigit(),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'type' => $faker->randomElement(['Dog', 'Cat', 'Hamster']),
                "images" => $faker->image(
                    "public/uploads/animals",
                    640,
                    480,
                    null,
                    false
                ),
            ]);
        }
    }
}
