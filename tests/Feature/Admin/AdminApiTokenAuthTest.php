<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminApiTokenAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_authenticate_with_token_and_call_api()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        \Laravel\Sanctum\Sanctum::actingAs($admin);

        $response = $this->getJson('/api/admin/users');

        $response->assertStatus(200);
    }

    public function test_token_denied_for_non_admin()
    {
        $user = User::factory()->create(['role' => 'parent']);
        \Laravel\Sanctum\Sanctum::actingAs($user);

        $response = $this->getJson('/api/admin/users');

        $response->assertStatus(403);
    }
}
