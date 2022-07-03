<?php

namespace App\Http\Clients;

use App\Interfaces\YoutubeClientInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class YoutubeFakeClient implements YoutubeClientInterface
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = URL::to('/');
    }

    public function getAllChannelsWithVideos(): array
    {
        $response = Http::get($this->baseUrl . '/api/v1/videos');

        if ($response->ok()) {
            return json_decode($response->body(), true);
        } else {
            logger()->error('Error fetching channel data from YouTube!');
            return [];
        }
    }
}
