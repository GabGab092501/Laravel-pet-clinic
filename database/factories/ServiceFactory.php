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
            "service_name" => $this->faker->randomElement([
                "Ear clean",
                "Cut teddy bear",
                "Wash hair",
                "Comb hair",
                "Nail clipping",
                "Blow dry",
            ]),
            "cost" => $this->faker->randomFloat(2, 0, 10000),
            "images" => $this->faker->image(
                "public/uploads/services",
                640,
                480,
                null,
                false
            ),
        ];
    }
}
