<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            Student::create([
                'fname'  => $faker->fname,
                'lname' => $faker->lname,
                'email' => $faker->email,
            ]);
        }
    }
}
