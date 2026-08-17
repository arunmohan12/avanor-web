<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\PriceFormatter;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Enums\Fit;

class Property extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

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

        $this
            ->addMediaCollection('gallery')
            ->useDisk('s3');
    }
    public function registerMediaConversions(?Media $media = null): void
    {
        // Cover
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
    
        // Gallery
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
    
        $this->addMediaConversion('gallery_thumb_avif')
            ->format('avif')
            ->width(400)
            ->quality(60)
            ->nonQueued();
    
        $this->addMediaConversion('gallery_avif')
            ->format('avif')
            ->width(1920)
            ->quality(75)
            ->nonQueued();
    
        // Section images
        $this->addMediaConversion('section_image_mobile_avif')
            ->format('avif')
            ->width(768)
            ->quality(65)
            ->nonQueued();
    
        $this->addMediaConversion('section_image_tablet_avif')
            ->format('avif')
            ->width(1280)
            ->quality(70)
            ->nonQueued();
    

    }
    protected $fillable = [
        'developer_id',
        'project_id',
        'emirate_id',
        'community_id',
        'property_type_id',

        'title',
        'slug',

        'status',

        'bedrooms',
        'bathrooms',
        'price',

        'thumbnail',
        'cover_image',

        'map_url',
        'description',

        'meta_title',
        'meta_description',
        'meta_keywords',

        'is_featured',
        'is_active',

        'display_order',
        'payment_plan',
        'handover_quarter',
        'handover_year',
        'starting_price',
    ];

    protected $casts = [
        'price' => 'decimal:2',

        'bedrooms' => 'integer',
        'bathrooms' => 'integer',

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

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function emirate()
    {
        return $this->belongsTo(Emirate::class);
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }
    public function images()
    {
        return $this->hasMany(PropertyImage::class);
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

    protected function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn() => PriceFormatter::aed($this->price),
        );
    }
    public function unitTypes(): HasMany
    {
        return $this->hasMany(PropertyUnitType::class)
            ->orderBy('display_order');
    }
    public function sections(): HasMany
    {
        return $this->hasMany(PropertySection::class)
            ->orderBy('display_order');
    }
    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class);
    }
}
