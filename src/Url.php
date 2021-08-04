<?php

namespace Firebed\Sitemap;

use Illuminate\Support\Carbon;

class Url
{
    public const CHANGE_FREQ_ALWAYS  = 'always';
    public const CHANGE_FREQ_HOURLY  = 'hourly';
    public const CHANGE_FREQ_DAILY   = 'daily';
    public const CHANGE_FREQ_WEEKLY  = 'weekly';
    public const CHANGE_FREQ_MONTHLY = 'monthly';
    public const CHANGE_FREQ_YEARLY  = 'yearly';
    public const CHANGE_FREQ_NEVER   = 'never';

    public ?string  $loc;
    public Carbon  $lastmod;
    public ?string $changefreq;
    public float   $priority;

    public array $images;

    public array $alternates = [];

    public function __construct(string $url = NULL, Carbon|string $lastmod = NULL, string $changefreq = NULL, float $priority = 0.8)
    {
        $this->loc = $url;
        $this->lastmod = $this->toDateTime($lastmod);
        $this->changefreq = $changefreq;
        $this->priority = $priority;
    }

    public function addAlternate(string $url, string $locale): static
    {
        $this->alternates[] = new Alternate($url, $locale);
        return $this;
    }

    public function addImage(Image|string $image, string $title = null): static
    {
        if (is_string($image)) {
            $image = new Image($image, title: $title);
        }

        $this->images[] = $image;
        return $this;
    }

    private function toDateTime($datetime): Carbon
    {
        if (empty($datetime)) {
            return $this->lastmod = Carbon::now();
        }

        return is_string($datetime) ? Carbon::createFromTimestamp($datetime) : $datetime;
    }
}