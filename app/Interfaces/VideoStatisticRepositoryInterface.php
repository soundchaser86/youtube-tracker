<?php

namespace App\Interfaces;

interface VideoStatisticRepositoryInterface
{
    public function create(array $data);
    public function update(int $videoStatisticId, array $data);
}
