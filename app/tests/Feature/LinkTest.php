<?php

namespace Tests\Feature;

use App\Models\Link;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LinkTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_short_link(): void
    {
        $response = $this->postJson('/api/links', [
            'url' => 'https://example.com/some/long/url',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'code',
                'short_url',
            ]);

        $this->assertDatabaseHas('links', [
            'url' => 'https://example.com/some/long/url',
        ]);
    }

    public function test_redirect_increments_clicks(): void
    {
        $link = Link::create([
            'url' => 'https://example.com',
            'code' => 'ABC123',
            'clicks' => 0,
        ]);

        $this->get('/ABC123')
            ->assertStatus(302)
            ->assertRedirect('https://example.com');

        $this->assertDatabaseHas('links', [
            'code' => 'ABC123',
            'clicks' => 1,
        ]);
    }

    public function test_stats_returns_link_data(): void
    {
        $link = Link::create([
            'url' => 'https://example.com',
            'code' => 'ABC123',
            'clicks' => 5,
        ]);

        $response = $this->getJson('/api/links/ABC123/stats');

        $response->assertStatus(200)
            ->assertJson([
                'url' => 'https://example.com',
                'code' => 'ABC123',
                'clicks' => 5,
            ]);
    }

    public function test_unknown_code_returns_404(): void
    {
        $this->get('/UNKNOWN')
            ->assertStatus(404);

        $this->getJson('/api/links/UNKNOWN/stats')
            ->assertStatus(404);
    }
}
