<?php

namespace Database\Factories;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VideoStatistic>
 */
class VideoStatisticFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'video_id' => Video::factory(),
            'views' => rand(100, 10000),
            'views_first_hour' => function (array $attributes) {
                return rand(10, ceil((20 / 100) * $attributes['views']));
            },
            'likes' => function (array $attributes) {
                return rand(10, $attributes['views']);
            },
            'dislikes' => function (array $attributes) {
                return rand(5, $attributes['likes'] - 1);
            },
            'comment_count' => function (array $attributes) {
                return rand(20, ceil((15 / 100) * $attributes['views']));
            },
        ];
    }
}
