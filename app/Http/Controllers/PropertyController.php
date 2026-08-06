<?php

namespace App\Http\Controllers;

use App\Services\PropertySearchService;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

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
}