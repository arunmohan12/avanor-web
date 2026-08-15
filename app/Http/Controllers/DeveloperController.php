<?php

namespace App\Http\Controllers;
use App\Models\Developer;
use App\Models\Property;

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
            ->limit(3)
            ->get();

        return view('developers.devdetails', compact(
            'developer',
            'properties'
        ));
    }
}