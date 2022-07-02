<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Channel extends Model
{
    use HasFactory;

    protected $casts = [
        'views_first_hour_median' => 'integer',
    ];

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }
}
