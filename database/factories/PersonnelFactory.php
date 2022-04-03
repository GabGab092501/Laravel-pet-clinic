<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personnel>
 */
class PersonnelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'full_name' =>$this->faker->name,
            'email' =>$this->faker->unique()->safeEmail(),
            'password' =>$this->faker->password(),
            'role' =>$this->faker->randomElement(['Veterinarian' ,'Volunteer', 'Employee']),
        ];
    }
}
