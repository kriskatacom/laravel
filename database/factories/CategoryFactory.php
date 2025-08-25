<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(2, true), 
            'description' => $this->faker->sentence(),
            'image_url' => $this->faker->imageUrl(640, 480, 'cats', true), // рандом image url
            'parent_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
