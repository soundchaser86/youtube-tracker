<?php

namespace App\Interfaces;

interface ChannelRepositoryInterface
{
    public function getAllWithVideos();
    public function getByYoutubeId(string $youtubeId);
}
