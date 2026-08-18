<?php

namespace App\Http\Controllers;
use App\Models\Developer;
use App\Models\Property;
use App\Models\Community;
class DeveloperController extends Controller
{
    public function index()
    {
    
 

        return view('developers.partners');
    }

    public function show(string $slug)
    {
        $developer = Developer::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $properties = Property::query()
            ->where('developer_id', $developer->id)
            ->where('is_active', true)
            ->with([
                'project',
                'media',
            ])
            ->latest()
         
            ->get();

            $communities = Community::query()
            ->select([
                'id',
                'name',
                'slug',
                'thumbnail',
                'description',
            ])
            ->where('is_active', true)
            ->where('is_featured', true)
        
            // Only communities having properties from this developer
            ->whereHas('properties', function ($query) use ($developer) {
                $query
                    ->where('is_active', true)
                    ->where('developer_id', $developer->id);
            })
        
            // Count only this developer's active properties
            ->withCount([
                'properties' => function ($query) use ($developer) {
                    $query
                        ->where('is_active', true)
                        ->where('developer_id', $developer->id);
                },
            ])
        
            ->orderBy('display_order')
            ->get();

        return view('developers.devdetails', compact(
            'developer',
            'properties',
            'communities'
        ));
    }
}