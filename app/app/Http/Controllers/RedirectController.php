<?php

namespace App\Http\Controllers;

use App\Services\LinkService;

class RedirectController extends Controller
{
    public function __construct(
        private readonly LinkService $service
    ) {}

    public function __invoke(string $code)
    {
        $link = $this->service->resolve($code);

        return redirect()->away($link->url, 302);
    }
}
