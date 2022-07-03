<?php

namespace App\Repositories;

use App\Interfaces\VideoRepositoryInterface;
use App\Models\Video;
use Illuminate\Pagination\LengthAwarePaginator;

class VideoRepository implements VideoRepositoryInterface
{
    public function getAll(): LengthAwarePaginator
    {
        return Video::paginate(20);
    }

    public function getByYoutubeId(string $youtubeId): ?Video
    {
        return Video::where('youtube_id', $youtubeId)->first();
    }

    public function create(array $data): Video
    {
        return Video::create($data);
    }
}
