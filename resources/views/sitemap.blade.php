
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>

    <url>
        <loc>{{ route('blogs') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    @foreach ($blogs as $blog)
        <url>
            <loc>{{ route('blogs.show', $blog->slug) }}</loc>

            @if ($blog->updated_at)
                <lastmod>{{ $blog->updated_at->toAtomString() }}</lastmod>
            @endif

            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach
    @foreach ($properties as $property)
    <url>
        <loc>{{ route('properties.show', $property->slug) }}</loc>

        @if ($property->updated_at)
            <lastmod>{{ $property->updated_at->toAtomString() }}</lastmod>
        @endif

        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
@endforeach





<url>
    <loc>{{ route('properties.index') }}</loc>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
</url>




</urlset>