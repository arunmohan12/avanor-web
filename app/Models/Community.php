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
        'thumbnail',
        'hero',
        'is_featured',
    ];

    public function emirate(): BelongsTo
    {
        return $this->belongsTo(Emirate::class);
    }
    public function properties()
{
    return $this->hasMany(Property::class);
}
}
