<?php

namespace App\Console\Commands;

use App\Services\SyncService;
use Illuminate\Console\Command;

class SyncCommand extends Command
{
    protected $signature = 'sync';
    protected $description = 'Sync video data from YouTube';

    private SyncService $syncService;

    public function __construct(SyncService $syncService)
    {
        parent::__construct();

        $this->syncService = $syncService;
    }

    public function handle(): void
    {
        $this->syncService->sync();
    }
}
