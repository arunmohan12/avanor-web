<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Enums\Fit;
class PropertySection extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'property_id',
        'title',
        'content',
        'image',
        'layout',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('section_image')
            ->singleFile()
            ->useDisk('s3');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('section_image_avif')
            ->format('avif')
            ->width(1600)
            ->performOnCollections('section_image')
            ->nonQueued();
    }

    // existing property() relationship...
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}