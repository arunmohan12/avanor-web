<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Property;
use App\Models\Blog;
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

        $latestBlogs = $blogs
            ->reject(
                fn($blog) =>
                $featuredBlog && $blog->id === $featuredBlog->id
            )
            ->take(8)
            ->values();

        return view('home', [
            'featuredCommunities' => $featuredCommunities,
            'latestBlogs' =>$latestBlogs,
            'featuredProperties'  => $featuredProperties,
            'featuredBlog' => $featuredBlog,

        ]);
    }
}
