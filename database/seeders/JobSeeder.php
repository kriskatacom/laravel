<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Job;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            Job::create([
                'title' => $faker->jobTitle(),
                'description' => $faker->paragraph(3),
                'company' => $faker->company(),
                'location' => $faker->city(),
                'salary' => $faker->numberBetween(1000, 6000),
                'job_type' => $faker->randomElement(['Full-time', 'Part-time', 'Contract', 'Internship']),
                'image' => 'demo-company.png',
            ]);
        }
    }
}