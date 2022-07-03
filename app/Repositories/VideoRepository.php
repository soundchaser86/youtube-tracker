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
}
