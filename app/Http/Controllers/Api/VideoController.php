<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChannelCollection;
use App\Services\SyncService;

class VideoController extends Controller
{
    private SyncService $syncService;

    public function __construct(SyncService $syncService)
    {
        $this->syncService = $syncService;
    }

    public function index(): ChannelCollection
    {
        $channels = $this->syncService->generateFakeSyncData();

        return new ChannelCollection($channels);
    }
}
