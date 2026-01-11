<?php

namespace Tests\Feature;

use Tests\TestCase;

class HealthCheckTest extends TestCase
{
    public function test_health_endpoint_returns_ok_and_db_status()
    {
        $response = $this->get('/health');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status', 'app', 'env', 'db' => ['driver', 'ok'], 'time'
        ]);
        $this->assertTrue($response->json('db.ok'));
    }
}
