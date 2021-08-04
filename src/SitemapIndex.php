<?php

namespace Firebed\Sitemap;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class SitemapIndex implements Responsable, Renderable
{
    public array $sitemaps;

    public function addSitemap(string $loc, Carbon $lastmod = NULL): self
    {
        $this->sitemaps[] = new Url($loc, $lastmod);
        return $this;
    }

    public function addSitemapIf(bool $condition, callable $callback): self
    {
        if ($condition) {
            [$loc, $lastmod] = $callback();
            $this->addSitemap($loc, $lastmod);
        }
        return $this;
    }

    public function isEmpty(): bool
    {
        return empty($this->sitemaps);
    }

    public function writeToDisk(string $disk, string $path): void
    {
        Storage::disk($disk)->put($path, $this->render());
    }

    public function writeToFile(string $path): void
    {
        file_put_contents($path, $this->render());
    }

    public function render(): string
    {
        return View::make('sitemap::sitemap-index')
            ->with(['sitemaps' => $this->sitemaps])
            ->render();
    }

    public function toResponse($request): \Illuminate\Http\Response
    {
        return Response::make($this->render(), 200, [
            'Content-Type' => 'text/xml'
        ]);
    }
}