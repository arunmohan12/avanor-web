<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Property;

use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredCommunities = Community::query()
            ->select([
                'id',
                'name',
                'slug',
                'thumbnail',
            ])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->withCount([
                'properties' => function ($query) {
                    $query->where('is_active', true);
                },
            ])
            ->orderBy('name')
            ->limit(6)
            ->get();


            $featuredProperties = Property::query()
            ->select(
                'id',
                'title',
                'slug',
                'thumbnail',
                'price'
            )
            ->where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('display_order')
            ->limit(12)
            ->get();

        return view('home', [
            'featuredCommunities' => $featuredCommunities,
            'featuredProperties'  => $featuredProperties,

        ]);
    }
}