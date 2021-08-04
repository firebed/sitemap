<url>
    @if (!empty($url->loc))
    <loc>{{ URL::to($url->loc) }}</loc>
    @endif
    @if (!empty($url->lastmod))
    <lastmod>{{ $url->lastmod->format(DateTimeInterface::ATOM) }}</lastmod>
    @endif
    @if (!empty($url->changefreq))
    <changefreq>{{ $url->changefreq }}</changefreq>
    @endif
    @if (!empty($url->priority))
    <priority>{{ number_format($url->priority,1) }}</priority>
    @endif
    @if(!empty($url->images))
    @each('sitemap::image', $url->images, 'image')
    @endif
    @if (!empty($url->alternates))
    @foreach ($url->alternates as $alternate)
    <xhtml:link rel="alternate" hreflang="{{ $alternate->locale }}" href="{{ URL::to($alternate->url) }}"/>
    @endforeach
    @endif
</url>