<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoStatistic extends Model
{
    use HasFactory;

    protected $casts = [
        'views' => 'integer',
        'views_first_hour' => 'integer',
        'likes' => 'integer',
        'dislikes' => 'integer',
        'comment_count' => 'integer',
    ];
}
