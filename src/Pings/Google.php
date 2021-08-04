<?php

namespace Firebed\Sitemap\Pings;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class Google
{
    private const GOOGLE_URL = "https://www.google.com/ping?sitemap=";

    public static function pingSitemap($url): Response
    {
        return Http::get(self::GOOGLE_URL . $url);
    }
}