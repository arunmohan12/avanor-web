<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::query()
            ->where('is_active', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('display_order')
            ->orderByDesc('published_at')
            ->paginate(6);

        $recentPosts = Blog::query()
            ->where('is_active', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->limit(4)
            ->get();

        return view('blogs.list', compact(
            'blogs',
            'recentPosts'
        ));
    }

    public function show(string $slug)
    {
        $blog = Blog::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->firstOrFail();

        $recentPosts = Blog::query()
            ->where('is_active', true)
            ->where('id', '!=', $blog->id)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->limit(4)
            ->get();

        return view('blogs.detailed', compact(
            'blog',
            'recentPosts'
        ));
    }
}