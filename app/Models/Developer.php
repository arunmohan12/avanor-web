<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}

