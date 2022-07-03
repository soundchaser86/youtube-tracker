<?php

namespace App\Repositories;

use App\Interfaces\ChannelRepositoryInterface;
use App\Models\Channel;
use Illuminate\Support\Collection;

class ChannelRepository implements ChannelRepositoryInterface
{
    public function getAllWithVideos(): Collection
    {
        return Channel::with('videos.statistic')->get();
    }

    public function getByYoutubeId(string $youtubeId): ?Channel
    {
        return Channel::where('youtube_id', $youtubeId)->first();
    }
}
