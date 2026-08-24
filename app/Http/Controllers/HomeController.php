<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Community;
use App\Models\HomeSetting;
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
            ->orderBy('display_order')
            ->limit(6)
            ->get();

        $featuredProperties = Property::query()
            ->select(
                'id',
                'developer_id',
                'project_id',
                'title',
                'slug',
                'price'
            )
            ->with([
                'developer:id,name',
                'unitTypes',
                'project:id,starting_price,location',
                'media',
            ])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('display_order')
            ->limit(12)
            ->get();

        $blogs = Blog::query()
            ->where('is_active', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->limit(8)
            ->get([
                'id',
                'title',
                'slug',
                'thumbnail',
                'excerpt',
                'published_at',
                'is_featured',
                'category',
            ]);

        $featuredBlog = $blogs->firstWhere('is_featured', true)
            ?? $blogs->first();
        $homeSettings = HomeSetting::query()->first();
        $latestBlogs = $blogs
            ->reject(
                fn ($blog) => $featuredBlog && $blog->id === $featuredBlog->id
            )
            ->take(8)
            ->values();

        return view('home', [
            'featuredCommunities' => $featuredCommunities,
            'latestBlogs' => $latestBlogs,
            'featuredProperties' => $featuredProperties,
            'featuredBlog' => $featuredBlog,
            'homeSettings' => $homeSettings,
        ]);
    }
}
