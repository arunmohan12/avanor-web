<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Services\FilterService;
use App\Services\PropertySearchService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function __construct(
        private PropertySearchService $propertySearchService,
        private FilterService $filterService,

    ) {}

    public function indexBefore(Request $request)
    {
        $properties = $this->propertySearchService->search($request);

        $filters = $this->filterService->getFilters();

        return view('properties.index', array_merge(
            ['properties' => $properties],
            $filters
        ));
    }

    public function index(): View
    {
        return view('properties.index');
    }

    public function show(string $slug)
    {
        $property = Property::query()
            ->with([
                'developer',
                'project',
                'emirate',
                'community',
                'propertyType',
                'images',
                'unitTypes.propertyType',
                'sections',
                'amenities',
            ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('properties.show', compact('property'));
    }
}
