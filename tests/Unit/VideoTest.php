<?php

namespace Tests\Unit;

use App\Models\Channel;
use App\Models\Video;
use App\Models\VideoStatistic;
use App\Models\VideoTag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VideoTest extends TestCase
{
    use RefreshDatabase;

    public function test_video_relationships()
    {
        $video = Video::factory()->create();
        VideoStatistic::factory()->for($video)->create();
        VideoTag::factory()->for($video)->create();

        $this->assertInstanceOf(Channel::class, $video->channel);
        $this->assertInstanceOf(VideoStatistic::class, $video->statistic);
        $this->assertInstanceOf(VideoTag::class, $video->tags->first());
    }
}
