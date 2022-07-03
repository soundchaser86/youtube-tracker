<?php

namespace App\Services;

use App\Constants;
use App\Interfaces\VideoRepositoryInterface;
use App\Interfaces\VideoStatisticRepositoryInterface;
use App\Models\Channel;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class VideoService
{
    private VideoRepositoryInterface $videoRepository;
    private VideoStatisticRepositoryInterface $videoStatisticRepository;

    public function __construct(
        VideoRepositoryInterface          $videoRepository,
        VideoStatisticRepositoryInterface $videoStatisticRepository
    )
    {
        $this->videoRepository = $videoRepository;
        $this->videoStatisticRepository = $videoStatisticRepository;
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->videoRepository->getAll();
    }

    public function create(Channel $channel, array $data): void
    {
        $data['youtube_id'] = $data['id'];
        $data['channel_id'] = $channel->id;

        $video = $this->videoRepository->create($data);

        $statisticData = $this->prepStatisticData($data);
        $statisticData['video_id'] = $video->id;
        $statisticData['views_first_hour'] = $this->getViewsFirstHourByDate($data['views'], $data['upload_date']);

        $this->videoStatisticRepository->create($statisticData);
    }

    public function update(Video $video, array $data): void
    {
        $video->loadMissing('statistic');

        $statisticData = $this->prepStatisticData($data);
        $statisticData['views_first_hour'] = $this->getViewsFirstHourByDate(
            $data['views'],
            $data['upload_date'],
            $video->statistic->views_first_hour
        );

        $this->videoStatisticRepository->update($video->statistic->id, $statisticData);
    }

    public function prepStatisticData(array $data): array
    {
        return [
            'views' => $data['views'],
            'likes' => $data['likes'],
            'dislikes' => $data['dislikes'],
            'comment_count' => $data['comment_count'],
        ];
    }

    public function getViewsFirstHourByDate(int $views, string $uploadDate, int $viewsFirstHour = 0): string
    {
        $startDate = Carbon::createFromFormat(Constants::DATETIME_FORMAT, $uploadDate);
        $diff = $startDate->diffInHours(Carbon::now());

        if ($diff > 0) {
            return $viewsFirstHour ?? 0;
        } else {
            return $views;
        }
    }
}
