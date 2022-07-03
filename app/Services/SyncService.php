<?php

namespace App\Services;

use App\Constants;
use App\Interfaces\ChannelRepositoryInterface;
use App\Interfaces\VideoRepositoryInterface;
use App\Interfaces\YoutubeClientInterface;
use App\Models\Video;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SyncService
{
    private YoutubeClientInterface $client;
    private ChannelService $channelService;
    private VideoService $videoService;
    private ChannelRepositoryInterface $channelRepository;
    private VideoRepositoryInterface $videoRepository;

    public function __construct(
        YoutubeClientInterface     $client,
        ChannelService             $channelService,
        VideoService               $videoService,
        ChannelRepositoryInterface $channelRepository,
        VideoRepositoryInterface   $videoRepository
    )
    {
        $this->client = $client;
        $this->channelService = $channelService;
        $this->videoService = $videoService;
        $this->channelRepository = $channelRepository;
        $this->videoRepository = $videoRepository;
    }

    public function sync(): void
    {
        $data = $this->client->getAllChannelsWithVideos();

        try {
            foreach ($data['data'] as $channel) {
                $channelExisting = $this->channelRepository->getByYoutubeId($channel['id']);

                foreach ($channel['videos'] as $video) {
                    $videoExisting = $this->videoRepository->getByYoutubeId($video['id']);

                    DB::beginTransaction();

                    if ($videoExisting) {
                        $this->videoService->update($videoExisting, $video);
                    } else {
                        $this->videoService->create($channelExisting, $video);
                    }

                    DB::commit();
                }

                $this->channelService->updateViewsFirstHourMedian($channelExisting);
            }

            logger('YouTube sync successful!');
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e);
        }
    }

    public function generateFakeSyncData(): Collection
    {
        $channels = $this->channelRepository->getAllWithVideos();

        $channels->each(function ($channel) {
            $channel->videos->each(function ($video) {
                $video->views = $video->statistic->views + rand(50, 1000);
                $video->likes = $video->statistic->likes + rand(30, 50);
                $video->dislikes = $video->statistic->dislikes + rand(0, 20);
                $video->comment_count = $video->statistic->comment_count + rand(10, 30);

                return $video;
            });

            $videoNew = Video::factory()->for($channel)->make();
            $videoNew->upload_date = now()->format(Constants::DATETIME_FORMAT);
            $videoNew->views = 10;
            $videoNew->likes = 3;
            $videoNew->dislikes = 0;
            $videoNew->comment_count = 1;

            $channel->videos->push($videoNew);
        });

        return $channels;
    }
}
