<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Video extends Model
{
    use HasFactory;

    protected $casts = [
        'duration' => 'integer',
    ];

    public function statistic(): HasOne
    {
        return $this->hasOne(VideoStatistic::class);
    }

    public function tags(): HasMany
    {
        return $this->hasMany(VideoTag::class);
    }
}
