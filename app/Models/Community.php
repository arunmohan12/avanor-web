<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Community extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'emirate_id',
        'name',
        'slug',
        'latitude',
        'longitude',
        'area',
        'is_active',
        'is_featured',
        'display_order',
        'description',
        'hero',
    ];

    public function emirate(): BelongsTo
    {
        return $this->belongsTo(Emirate::class);
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('thumbnail')
            ->singleFile()
            ->useDisk('s3');

        $this
            ->addMediaCollection('hero')
            ->singleFile()
            ->useDisk('s3');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('thumbnail_avif')
            ->format('avif')
            ->fit(Fit::Crop, 800, 600)
            ->performOnCollections('thumbnail')
            ->nonQueued();

        $this
            ->addMediaConversion('hero_avif')
            ->format('avif')
            ->fit(Fit::Crop, 1920, 1000)
            ->performOnCollections('hero')
            ->nonQueued();
    }
}