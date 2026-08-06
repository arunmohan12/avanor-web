<?php

namespace App\Services;

use App\Models\Community;
use App\Models\PropertyType;
use Illuminate\Support\Facades\Cache;

class FilterService
{
    public function getFiltersBefore(): array
    {
        return Cache::rememberForever('property_filters_v1', function () {

            return [

                'propertyTypes' => PropertyType::query()
                    ->select('id', 'name')
                    ->where('is_active', true)
                    ->orderBy('name')
                    ->get()
                    ->map(fn ($item) => [
                        'id' => $item->id,
                        'name' => $item->name,
                    ])
                    ->all(),

                'communities' => Community::query()
                    ->select('id', 'name')
                    ->where('is_active', true)
                    ->orderBy('name')
                    ->get()
                    ->map(fn ($item) => [
                        'id' => $item->id,
                        'name' => $item->name,
                    ])
                    ->all(),

                'bedrooms' => config('property.bedrooms'),

                'priceRanges' => config('property.price_ranges'),

            ];
        });
    }
    private const CACHE_KEY = 'property_filters_v3';

    public function getFilters(): array
    {
        return Cache::rememberForever(
            self::CACHE_KEY,
            function (): array {
                return [
                    'propertyTypes' => PropertyType::query()
                        ->where('is_active', true)
                        ->orderBy('name')
                        ->get(['id', 'name'])
                        ->map(fn (PropertyType $type): array => [
                            'id' => $type->id,
                            'name' => $type->name,
                        ])
                        ->all(),

                    'communities' => Community::query()
                        ->where('is_active', true)
                        ->orderBy('name')
                        ->get(['id', 'name'])
                        ->map(fn (Community $community): array => [
                            'id' => $community->id,
                            'name' => $community->name,
                        ])
                        ->all(),

                    'bedroomOptions' => config(
                        'property.bedrooms',
                        []
                    ),

                    'priceRanges' => config(
                        'property.price_ranges',
                        []
                    ),
                ];
            }
        );
    }
    public function clear(): void
    {
        Cache::forget('property_filters_v1');
    }
}