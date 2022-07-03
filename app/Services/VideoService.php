<?php

namespace App\Services;

use App\Interfaces\VideoRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class VideoService
{
    private VideoRepositoryInterface $videoRepository;

    public function __construct(VideoRepositoryInterface $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->videoRepository->getAll();
    }
}
