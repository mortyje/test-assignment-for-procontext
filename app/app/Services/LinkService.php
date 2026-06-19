<?php

namespace App\Services;

use App\Models\Link;
use App\Repositories\Contracts\LinkRepositoryInterface;
use Illuminate\Support\Str;

readonly class LinkService
{
    public function __construct(
        private LinkRepositoryInterface $repository
    ) {}

    public function create(string $url): Link
    {
        $existing = $this->repository->findByUrl($url);

        if ($existing) {
            return $existing;
        }

        $code = $this->generateUniqueCode();

        return $this->repository->create($url, $code);
    }

    public function resolve(string $code): Link
    {
        $link = $this->repository->findByCode($code);

        if (!$link) {
            abort(404);
        }

        $this->repository->incrementClicks($link);

        return $link;
    }

    public function getStats(string $code): Link
    {
        $link = $this->repository->findByCode($code);

        if (!$link) {
            abort(404);
        }

        return $link;
    }

    private function generateUniqueCode(): string
    {
        do {
            $code = strtoupper(Str::random(6));
        } while ($this->repository->findByCode($code));

        return $code;
    }
}
