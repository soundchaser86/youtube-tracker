<?php

namespace App\Interfaces;

interface VideoRepositoryInterface
{
    public function getAll();
    public function getByYoutubeId(string $youtubeId);
    public function create(array $data);
}
