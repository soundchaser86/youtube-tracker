<?php

namespace App\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface VideoRepositoryInterface
{
    public function getAll(): LengthAwarePaginator;
}
