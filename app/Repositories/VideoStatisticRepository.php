<?php

namespace App\Repositories;

use App\Interfaces\VideoStatisticRepositoryInterface;
use App\Models\VideoStatistic;

class VideoStatisticRepository implements VideoStatisticRepositoryInterface
{
    public function create(array $data): VideoStatistic
    {
        return VideoStatistic::create($data);
    }

    public function update(int $videoStatisticId, array $data): int
    {
        return VideoStatistic::where('id', $videoStatisticId)->update($data);
    }
}
