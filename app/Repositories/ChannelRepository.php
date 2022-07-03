<?php

namespace App\Repositories;

use App\Interfaces\ChannelRepositoryInterface;
use App\Models\Channel;
use Illuminate\Support\Collection;

class ChannelRepository implements ChannelRepositoryInterface
{
    public function getAllWithVideos(): Collection
    {
        return Channel::with('videos.statistic')
            ->get();
    }
}
