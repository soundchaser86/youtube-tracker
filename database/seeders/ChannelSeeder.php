<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\Video;
use App\Models\VideoStatistic;
use App\Models\VideoTag;
use App\Services\ChannelService;
use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    private ChannelService $channelService;

    public function __construct(ChannelService $channelService)
    {
        $this->channelService = $channelService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channels = Channel::factory()
            ->count(5)
            ->has(
                Video::factory()
                    ->count(10)
                    ->has(VideoStatistic::factory(), 'statistic')
                    ->has(VideoTag::factory()->count(5), 'tags')
            )
            ->create();

        foreach ($channels as $channel) {
            $this->channelService->updateViewsFirstHourMedian($channel);
        }
    }
}
