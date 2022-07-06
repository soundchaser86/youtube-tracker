<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VideoStatistic extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'video_id',
        'views',
        'views_first_hour',
        'likes',
        'dislikes',
        'comment_count',
    ];

    protected $casts = [
        'views' => 'integer',
        'views_first_hour' => 'integer',
        'likes' => 'integer',
        'dislikes' => 'integer',
        'comment_count' => 'integer',
    ];

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }
}
