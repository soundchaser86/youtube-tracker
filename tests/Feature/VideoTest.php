<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\Video;
use App\Models\VideoStatistic;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoTest extends TestCase
{
    use RefreshDatabase;

    public function test_video_index_ok()
    {
        $response = $this->get(route('videos.all'));

        $response->assertOk();
    }

    public function test_video_get_all()
    {
        $channelA = Channel::factory()->create(['views_first_hour_median' => 50]);
        $videoA = Video::factory()->for($channelA)->create();
        VideoStatistic::factory()->for($videoA)->create(['views_first_hour' => 51]);

        $channelB = Channel::factory()->create(['views_first_hour_median' => 100]);
        $videoB = Video::factory()->for($channelB)->create();
        VideoStatistic::factory()->for($videoB)->create(['views_first_hour' => 99]);

        $channelC = Channel::factory()->create(['views_first_hour_median' => 74]);
        $videoC = Video::factory()->for($channelC)->create();
        VideoStatistic::factory()->for($videoC)->create(['views_first_hour' => 90]);

        $response = $this->get(route('videos.getAll'));

        $response->assertJson(fn (AssertableJson $json) =>
            $json->hasAll([
                'current_page',
                'data',
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'links',
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total',
            ])
        );

        $arrayExpected = [
            [
                'name' => $videoC->name,
                'channel_name' => $videoC->channel->name,
                'views_first_hour' => $videoC->statistic->views_first_hour,
            ],
            [
                'name' => $videoA->name,
                'channel_name' => $videoA->channel->name,
                'views_first_hour' => $videoA->statistic->views_first_hour,
            ],
            [
                'name' => $videoB->name,
                'channel_name' => $videoB->channel->name,
                'views_first_hour' => $videoB->statistic->views_first_hour,
            ],
        ];

        $arrayActual = $response->json()['data'];

        $this->assertSame($arrayExpected, $arrayActual);
    }
}
