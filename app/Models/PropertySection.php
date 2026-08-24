<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
        // Cover image
        $this->addMediaConversion('cover_mobile_avif')
            ->format('avif')
            ->width(768)
            ->quality(65)
            ->nonQueued();

        $this->addMediaConversion('cover_tablet_avif')
            ->format('avif')
            ->width(1280)
            ->quality(70)
            ->nonQueued();

        $this->addMediaConversion('cover_avif')
            ->format('avif')
            ->width(1920)
            ->quality(75)
            ->nonQueued();

        // Gallery images
        $this->addMediaConversion('gallery_mobile_avif')
            ->format('avif')
            ->width(768)
            ->quality(65)
            ->nonQueued();

        $this->addMediaConversion('gallery_tablet_avif')
            ->format('avif')
            ->width(1280)
            ->quality(70)
            ->nonQueued();

        $this->addMediaConversion('gallery_avif')
            ->format('avif')
            ->width(1920)
            ->quality(75)
            ->nonQueued();
        $this->addMediaConversion('section_image_avif')
            ->format('avif')
            ->width(1600)
            ->quality(75)
            ->nonQueued();
    }

    // existing property() relationship...
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
