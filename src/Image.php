<?php

namespace Firebed\Sitemap;

class Image
{
    public string $loc;
    public ?string $caption;
    public ?string $geo_location;
    public ?string $title;
    public ?string $licence;

    public function __construct(string $loc, string $caption = null, string $geo_location = null, string $title = null, string $licence = null)
    {
        $this->loc = $loc;
        $this->caption = $caption;
        $this->geo_location = $geo_location;
        $this->title = $title;
        $this->licence = $licence;
    }
}