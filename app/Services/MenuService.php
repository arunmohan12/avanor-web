<?php

namespace App\Services;

use App\Models\Community;
use App\Models\Developer;
use App\Models\PropertyType;
use Illuminate\Support\Facades\Cache;

class MenuService
{
    public function propertySearch(): array
    {
        return Cache::remember(
            'property_search',
            now()->addHours(12),
            function () {

                return [

                    'propertyTypes' => PropertyType::query()
                        ->where('is_active', true)
                        ->orderBy('name')
                        ->get(['id', 'name'])
                        ->map(fn($item) => [
                            'id' => $item->id,
                            'name' => $item->name,
                        ])
                        ->all(),

                    'communities' => Community::query()
                        ->orderBy('name')
                        ->get(['id', 'name'])
                        ->map(fn($item) => [
                            'id' => $item->id,
                            'name' => $item->name,
                        ])
                        ->all(),

                    'bedrooms' => config('property.bedrooms'),

                    'priceRanges' => config('property.price_ranges'),

                ];
            }
        );
    }

    public function developers(): array
    {
        return Cache::remember(
            'menu_developers',
            now()->addHours(12),
            function () {

                return Developer::query()
                    ->where('is_active', true)
                    ->orderBy('display_order')
                    ->orderBy('name')
                    ->get(['id', 'name', 'slug','logo'])
                    ->map(fn($item) => [
                        'id' => $item->id,
                        'name' => $item->name,
                        'slug' => $item->slug,
                        'logo' => $item->logo,
                    ])
                    ->all();

            }
        );
    }
}