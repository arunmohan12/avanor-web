<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class PropertyType extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'is_active',
        'sort_order',
    ];

    public function propertyUnitTypes(): HasMany
{
    return $this->hasMany(PropertyUnitType::class);
}

}
