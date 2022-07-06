<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VideoTag extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }
}
