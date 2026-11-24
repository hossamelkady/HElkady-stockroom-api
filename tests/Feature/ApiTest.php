<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_health_endpoint_returns_ok(): void
    {
        $this->getJson('/api/health')->assertOk()->assertJson(['status' => 'ok']);
    }

    public function test_can_create_and_list_items(): void
    {
        $this->postJson('/api/items', ['sku' => 'KB-104', 'name' => 'Wireless keyboard', 'quantity' => 18, 'reorder_level' => 6, 'unit_price' => '24.90'])
            ->assertCreated()->assertJsonPath('data.sku', 'KB-104');

        $this->getJson('/api/items')->assertOk()->assertJsonPath('total', 1);
    }

    public function test_invalid_payload_is_rejected(): void
    {
        $this->postJson('/api/items', [])->assertUnprocessable();
    }
}
