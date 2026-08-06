<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Developer extends Model

{    
    
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'cover_image',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'website',
        'is_featured',
        'is_active',
        'display_order',
    ];

    // public function projects()
    // {
    //     return $this->hasMany(Project::class);
    // }

    // public function properties()
    // {
    //     return $this->hasMany(Property::class);
    // }

    protected static function booted(): void
{
    static::saved(function () {
        Cache::forget('menu_developers');
    });

    static::deleted(function () {
        Cache::forget('menu_developers');
    });
}
}

