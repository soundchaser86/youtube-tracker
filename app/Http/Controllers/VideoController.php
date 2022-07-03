<?php

namespace App\Http\Controllers;

use App\Services\VideoService;
use Illuminate\View\View;

class VideoController extends Controller
{
    private VideoService $videoService;

    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
    }

    public function index(): View
    {
        $videos = $this->videoService->getAll();

        return view('video.index', compact('videos'));
    }
}
