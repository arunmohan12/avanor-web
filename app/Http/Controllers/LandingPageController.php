<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Support\MediaUrl;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LandingPageController extends Controller
{
    public function show(string $slug)
    {

    $start = microtime(true);

    $queryCount = 0;
    $queryTime = 0;

    DB::listen(function (QueryExecuted $query) use (&$queryCount, &$queryTime) {
        $queryCount++;
        $queryTime += $query->time;
    });

        $property = Property::query()
            ->with([
                'developer',
                'project',
                'community',
                'emirate',
                'unitTypes.propertyType',
                'amenities',
                'sections',
            ])
            ->where('slug', $slug)

            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Cover Image
        |--------------------------------------------------------------------------
        */

        $coverMedia = $property->getFirstMedia('cover');

        $propertyImageUrl = $coverMedia
            ? MediaUrl::fromMedia(
                $coverMedia,
                'cover_avif'
            )
            : null;

        /*
        |--------------------------------------------------------------------------
        | Gallery Images
        |--------------------------------------------------------------------------
        */

        $galleryImages = $property->getMedia('gallery');

        // First 2 gallery images used in hero after cover
        $heroGalleryImages = $galleryImages->take(2);

        $hasHeroImages =
            $coverMedia !== null ||
            $heroGalleryImages->isNotEmpty();

        /*
        |--------------------------------------------------------------------------
        | Unit Types
        |--------------------------------------------------------------------------
        */

        $unitTypes = $property->unitTypes;

        /*
        |--------------------------------------------------------------------------
        | Amenities
        |--------------------------------------------------------------------------
        */

        $amenities = $property->amenities;

        /*
        |--------------------------------------------------------------------------
        | Content Sections
        |--------------------------------------------------------------------------
        */

        $activeSections = $property->sections
            ->where('is_active', true)
            ->sortBy('display_order')
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Property Facts
        |--------------------------------------------------------------------------
        */

        $hasFacts =
            filled($property->starting_price) ||
            filled($property->price) ||
            $unitTypes->isNotEmpty() ||
            filled($property->handover_quarter) ||
            filled($property->handover_year) ||
            filled($property->payment_plan);

        /*
        |--------------------------------------------------------------------------
        | Project Description
        |--------------------------------------------------------------------------
        */

        $hasProjectDescription =
            $property->project !== null &&
            filled($property->project->description);

        /*
        |--------------------------------------------------------------------------
        | View
        |--------------------------------------------------------------------------
        */
Log::info('LANDING PERFORMANCE', [
    'slug' => $slug,
    'controller_ms' => round((microtime(true) - $start) * 1000, 2),
    'query_count' => $queryCount,
    'query_ms' => round($queryTime, 2),
]);
//        return view('landingpages.emaar.the-heights', compact(
//            'property',
//            'coverMedia',
//            'propertyImageUrl',
//            'galleryImages',
//            'heroGalleryImages',
//            'hasHeroImages',
//            'unitTypes',
//            'amenities',
//            'activeSections',
//            'hasFacts',
//            'hasProjectDescription',
//        ));

        $viewStart = microtime(true);

        $html = view('landingpages.emaar.the-heights', compact(
            'property',
            'coverMedia',
            'galleryImages',
            'unitTypes',
            'amenities',
            'activeSections',
            'heroGalleryImages',
            'hasHeroImages',
            'propertyImageUrl',
            'hasFacts',
            'hasProjectDescription',
        ))->render();

        Log::info('LANDING VIEW PERFORMANCE', [
            'view_ms' => round((microtime(true) - $viewStart) * 1000, 2),
            'total_ms' => round((microtime(true) - $start) * 1000, 2),
        ]);

        return response($html);
    }
}
