<?php

namespace App\Services;

use App\Models\Channel;

class ChannelService
{
    public function getViewsFirstHourMedian(Channel $channel): int
    {
        $channel->loadMissing('videos.statistic');

        $videos = $channel->videos;

        if ($videos->isNotEmpty()) {
            $median = $videos->median('statistic.views_first_hour');
        } else {
            $median = 0;
        }

        return $median;
    }

    public function updateViewsFirstHourMedian(Channel $channel): void
    {
        $channel->loadMissing('videos.statistic');

        $channel->views_first_hour_median = $this->getViewsFirstHourMedian($channel);
        $channel->save();
    }
}
