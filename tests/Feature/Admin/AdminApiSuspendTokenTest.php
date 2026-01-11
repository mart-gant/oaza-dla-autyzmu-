<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminApiSuspendTokenTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_suspend_user_with_token()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['is_suspended' => false]);

        \Laravel\Sanctum\Sanctum::actingAs($admin);

        $response = $this->postJson('/api/admin/users/'.$user->id.'/suspend');

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'is_suspended' => 1]);
    }
}
