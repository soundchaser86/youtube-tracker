<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'youtube_id' => Str::random(11),
            'name' => fake()->sentence(),
            'duration' => rand(60, 5400),
            'upload_date' => fake()->dateTimeBetween('-30 days')->format('Y-m-d H:i:s'),
        ];
    }
}
