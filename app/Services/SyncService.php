<?php

namespace App\Services;

use App\Interfaces\ChannelRepositoryInterface;
use App\Interfaces\YoutubeClientInterface;
use App\Models\Video;
use Illuminate\Support\Collection;

class SyncService
{
    private YoutubeClientInterface $client;
    private ChannelRepositoryInterface $channelRepository;

    public function __construct(YoutubeClientInterface $client, ChannelRepositoryInterface $channelRepository)
    {
        $this->client = $client;
        $this->channelRepository = $channelRepository;
    }

    public function sync(): void
    {
        $this->client->getAllChannelsWithVideos();

        // TODO: update recdords
    }

    public function generateFakeSyncData(): Collection
    {
        $channels = $this->channelRepository->getAllWithVideos();

        $channels->map(function ($channel) {
            $channel->videos->map(function ($video) {
                $video->views = $video->statistic->views + rand(50, 1000);
                $video->likes = $video->statistic->likes + rand(30, 50);
                $video->dislikes = $video->statistic->dislikes + rand(0, 20);
                $video->comment_count = $video->statistic->comment_count + rand(10, 30);

                return $video;
            });

            $videoNew = Video::factory()->for($channel)->make();
            $videoNew->views = 10;
            $videoNew->likes = 3;
            $videoNew->dislikes = 0;
            $videoNew->comment_count = 1;

            $channel->videos->push($videoNew);
        });

        return $channels;
    }
}
