{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($urls as $url)
    <url>
        <loc>{{ $url['loc'] }}</loc>
        @foreach (['lastmod', 'changefreq', 'priority'] as $tag)
            @isset($url[$tag])
                <{{ $tag }}>{{ $url[$tag] }}</{{ $tag }}>
            @endisset
        @endforeach
    </url>
    @endforeach
</urlset>
