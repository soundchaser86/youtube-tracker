<?php

namespace App\Interfaces;

interface YoutubeClientInterface
{
    public function getAllChannelsWithVideos(): array;
}
