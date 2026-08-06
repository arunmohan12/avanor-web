<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\PriceFormatter;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Property extends Model
{
    use HasFactory;

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
}
