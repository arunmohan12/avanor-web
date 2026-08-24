<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'developer_id',
        'emirate_id',
        'community_id',

        'name',
        'slug',

        'status',

        'starting_price',
        'handover_quarter',
        'handover_year',

        'short_description',
        'description',

        'map_url',

        'meta_title',
        'meta_description',
        'meta_keywords',

        'is_featured',
        'is_active',

        'display_order',
        'payment_plan',
        'location',
    ];

    protected $casts = [
        'status' => ProjectStatus::class,
        'starting_price' => 'decimal:2',
        'handover_year' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function developer()
    {
        return $this->belongsTo(Developer::class);
    }

    public function emirate()
    {
        return $this->belongsTo(Emirate::class);
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function unitTypes(): HasMany
    {
        return $this->hasMany(ProjectUnitType::class)
            ->orderBy('display_order');
    }

    /*
    |--------------------------------------------------------------------------
    | Media
    |--------------------------------------------------------------------------
    */

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('thumbnail')
            ->singleFile()
            ->useDisk('s3');

        $this
            ->addMediaCollection('cover')
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
            ->addMediaConversion('cover_avif')
            ->format('avif')
            ->fit(Fit::Crop, 1920, 1000)
            ->performOnCollections('cover')
            ->nonQueued();
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
