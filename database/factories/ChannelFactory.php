<?php

namespace Database\Factories;

use App\Models\Channel;
use App\Services\ChannelService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ChannelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'youtube_id' => Str::random(24),
            'name' => fake()->company(),
            'views_first_hour_median' => rand(100, 10000),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Channel $channel) {
            //
        })->afterCreating(function (Channel $channel) {
            resolve(ChannelService::class)->updateViewsFirstHourMedian($channel);
        });
    }
}
