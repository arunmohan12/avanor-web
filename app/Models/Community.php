<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Community extends Model
{
    protected $fillable = [
        'emirate_id',
        'name',
        'slug',
        'latitude',
        'longitude',
        'area',
        'is_active',
    ];

    public function emirate(): BelongsTo
    {
        return $this->belongsTo(Emirate::class);
    }
}
