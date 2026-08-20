<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Property;
use App\Models\Project;
use App\Models\Community;
use App\Models\Developer;
class SitemapController extends Controller
{
    public function index()
    {
        $blogs = Blog::query()
            ->where('is_active', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('updated_at')
            ->get(['slug', 'updated_at']);

        $properties = Property::query()
            ->where('is_active', true)
            ->orderByDesc('updated_at')
            ->get(['slug', 'updated_at']);

        $projects = Project::query()
            ->where('is_active', true)
            ->orderByDesc('updated_at')
            ->get(['slug', 'updated_at']);

        $communities = Community::query()
            ->where('is_active', true)
            ->orderByDesc('updated_at')
            ->get(['slug', 'updated_at']);

            $developers = Developer::query()
            ->where('is_active', true)
            ->get([
                'slug',
                'updated_at',
            ]);

        return response()
            ->view('sitemap', compact(
                'blogs',
                'properties',
                'projects',
                'communities',
                'developers'
            ))
            ->header('Content-Type', 'application/xml');
    }
}