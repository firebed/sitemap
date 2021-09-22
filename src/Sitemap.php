<?php

namespace Firebed\Sitemap;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class Sitemap implements Responsable, Renderable
{
    public array $urls = [];

    public function addUrl(Url|string $url, Carbon|string $lastmod = NULL, string $changefreq = NULL, float $priority = 0.8): static
    {
        if ($url instanceof Url) {
            $this->urls[] = $url;
            return $this;
        }

        $this->urls[] = new Url($url, $lastmod, $changefreq, $priority);
        return $this;
    }

    public function writeToDisk(string $disk, string $path): void
    {
        Storage::disk($disk)->put($path, $this->render());
    }

    public function writeToFile(string $path): void
    {
        file_put_contents($path, $this->render());
    }

    public function totalUrls(): int
    {
        return count($this->urls);
    }

    public function render(): string
    {
        return View::make('sitemap::sitemap')
            ->with(['urls' => $this->urls])
            ->render();
    }

    public function toResponse($request): \Illuminate\Http\Response
    {
        return Response::make($this->render(), 200, [
            'Content-Type' => 'text/xml'
        ]);
    }
}