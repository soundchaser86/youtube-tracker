<?php

namespace App\Providers;

use App\Http\Clients\YoutubeFakeClient;
use App\Interfaces\ChannelRepositoryInterface;
use App\Interfaces\VideoRepositoryInterface;
use App\Interfaces\YoutubeClientInterface;
use App\Repositories\ChannelRepository;
use App\Repositories\VideoRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(YoutubeClientInterface::class, YoutubeFakeClient::class);
        $this->app->bind(ChannelRepositoryInterface::class, ChannelRepository::class);
        $this->app->bind(VideoRepositoryInterface::class, VideoRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
