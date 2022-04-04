<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "service_name" =>$this->faker->name,
            "cost"  =>$this->faker->randomDigit,
            "images" => "https://i.picsum.photos/id/805/200/200.jpg?hmac=_YsptA4tmhnOwjWiLyYwiOuvOs30wULvKSLP6KESMg0",
        ];
    }
}
