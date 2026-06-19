<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use App\Http\Resources\LinkStatsResource;
use App\Services\LinkService;
use Illuminate\Http\JsonResponse;

class LinkController extends Controller
{
    public function __construct(
        private readonly LinkService $service
    ) {}

    public function store(StoreLinkRequest $request): JsonResponse
    {
        $link = $this->service->create(
            $request->validated('url')
        );

        return response()->json([
            'code' => $link->code,
            'short_url' => url($link->code),
        ]);
    }

    public function stats(string $code): LinkStatsResource
    {
        $link = $this->service->getStats($code);

        return new LinkStatsResource($link);
    }
}
