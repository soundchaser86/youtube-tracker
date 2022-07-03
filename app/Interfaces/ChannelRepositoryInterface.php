<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface ChannelRepositoryInterface
{
    public function getAllWithVideos(): Collection;
}
