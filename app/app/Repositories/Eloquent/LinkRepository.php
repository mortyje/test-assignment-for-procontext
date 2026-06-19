<?php

namespace App\Repositories\Eloquent;

use App\Models\Link;
use App\Repositories\Contracts\LinkRepositoryInterface;

class LinkRepository implements LinkRepositoryInterface
{

    public function findByCode(string $code): ?Link
    {
        return Link::where('code', $code)->first();
    }

    public function findByUrl(string $url): ?Link
    {
        return Link::where('url', $url)->first();
    }

    public function create(string $url, string $code): Link
    {
        return Link::create([
            'url' => $url,
            'code' => $code,
        ]);
    }

    public function incrementClicks(Link $link): void
    {
        $link->increment('clicks');
    }
}
