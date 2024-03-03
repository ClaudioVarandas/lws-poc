<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiTest extends TestCase
{
    public function test_base_url_returns_success(): void
    {
        $response = $this->get('/api/v1/');

        $response->assertStatus(200);
    }

    public function test_servers_endpoint_returns_success(): void
    {
        $response = $this->get('/api/v1/servers');

        $response->assertStatus(200);
    }
}
