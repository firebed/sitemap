<?php

namespace Firebed\Sitemap;

class Alternate
{
    public string $url;
    public string $locale;

    public function __construct(string $url, string $locale)
    {
        $this->url = $url;
        $this->locale = $locale;
    }
}