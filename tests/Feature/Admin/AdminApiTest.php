<?php

namespace Tests\Feature\Admin;

use App\Models\Facility;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group admin
 */
class AdminApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_list_users_json()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        User::factory()->count(2)->create();

        $response = $this->actingAs($admin)->getJson('/api/admin/users');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);
    }

    public function test_admin_can_delete_user_json()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create();

        $response = $this->actingAs($admin)->deleteJson('/api/admin/users/'.$user->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_non_admin_cannot_access_api()
    {
        $user = User::factory()->create(['role' => 'parent']);

        $response = $this->actingAs($user)->getJson('/api/admin/users');
        $response->assertStatus(403);
    }

    public function test_admin_can_list_facilities_json()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Facility::factory()->count(2)->create();

        $response = $this->actingAs($admin)->getJson('/api/admin/facilities');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);
    }
}
