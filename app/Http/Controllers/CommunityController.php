<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Emirate;
use App\Models\Property;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function index(Request $request)
    {
        $emirates = Emirate::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get([
                'id',
                'name',
            ]);

        $communities = Community::query()
            ->select([
                'id',
                'emirate_id',
                'name',
                'slug',
                'description',
                'display_order',
            ])
            ->with('emirate')

            ->withCount([
                'properties' => function ($query) {
                    $query->where('is_active', true);
                },
            ])

            ->where('is_active', true)

            ->when(
                $request->filled('emirate'),
                function ($query) use ($request) {
                    $query->where(
                        'emirate_id',
                        $request->integer('emirate')
                    );
                }
            )

            ->orderBy('display_order')
            ->get();

        return view('communities.index', compact(
            'communities',
            'emirates'
        ));
    }

    public function show(string $slug)
{
    $community = Community::query()
        ->with(['emirate'])
        ->where('slug', $slug)
        ->where('is_active', true)
        ->firstOrFail();

    $properties = Property::query()
    ->where('community_id', $community->id)
    ->where('is_active', true)
    ->with([
        'developer',
        'community',
        'propertyType',
        'project',
        'media',
    ])
    ->latest()
    ->get();


    $newLaunches = Property::query()
    ->with([
        'developer',
        'community',
        'project',
        'media',
    ])
    ->where('community_id', $community->id)
    ->where('developer_id', $community->developer_id)
    ->where('is_active', true)
    ->latest()
    ->take(5)
    ->get();

    return view('communities.detailed', compact(
        'community',
        'properties',
        'newLaunches'
    ));
}
}
