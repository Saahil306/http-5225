<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;

class CourseFactory extends Factory
{
    // The name of the factory's corresponding model
    protected $model = Course::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->words(3, true), // e.g., "Advanced Math Concepts"
            'description' => $this->faker->sentence(10), // A short course description
        ];
    }
}
