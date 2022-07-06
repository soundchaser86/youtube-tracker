<?php

namespace App\Http\Controllers;

use App\Services\VideoService;
use Illuminate\Http\JsonResponse;
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
        return view('video.index');
    }

    public function getAll(): JsonResponse
    {
        $videos = $this->videoService->getAll();

        return response()->json($videos);
    }
}
