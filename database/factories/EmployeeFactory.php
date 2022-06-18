<?php

namespace Database\Factories;

use App\Models\EmployeeRole;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'surname' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date,
            'email' => $this->faker->email,
            'employee_role_id' => EmployeeRole::find($this->faker->numberBetween(1, EmployeeRole::all()->count()))
        ];
    }
}
