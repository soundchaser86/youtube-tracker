<?php

namespace App\Repositories;

use App\Interfaces\VideoRepositoryInterface;
use App\Models\Video;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class VideoRepository implements VideoRepositoryInterface
{
    public function getAll(array $filter): LengthAwarePaginator
    {
        return DB::table('videos AS v')
            ->join('channels AS c', 'c.id', '=', 'v.channel_id')
            ->join('video_statistics AS vs', 'v.id', '=', 'vs.video_id')
            ->when(isset($filter['name']), function ($query) use ($filter) {
                $query->where('v.name', 'like', '%' . $filter['name'] . '%');
            })
            // order by performance
            ->orderByRaw('((c.views_first_hour_median + 0.0001) / (vs.views_first_hour + 0.0001)) ASC')
            ->orderBy('v.name')
            ->select([
                'v.name AS name',
                'c.name AS channel_name',
                'vs.views_first_hour AS views_first_hour',
            ])
            ->paginate(20);
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
