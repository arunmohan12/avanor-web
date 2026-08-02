<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

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

        'thumbnail',
        'cover_image',

        'short_description',
        'description',

        'map_url',

        'meta_title',
        'meta_description',
        'meta_keywords',

        'is_featured',
        'is_active',

        'display_order',
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