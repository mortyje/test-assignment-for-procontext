<?php

namespace App\Repositories\Contracts;

use App\Models\Link;

interface LinkRepositoryInterface
{
    public function findByCode(string $code): ?Link;

    public function findByUrl(string $url): ?Link;

    public function create(string $url, string $code): Link;

    public function incrementClicks(Link $link): void;
}
