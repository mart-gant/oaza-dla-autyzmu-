<?php

namespace Tests\Feature\Admin;

use App\Models\Facility;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminFacilityManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_facilities()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Facility::factory()->count(2)->create();

        $response = $this->actingAs($admin)->get('/admin/facilities');

        $response->assertStatus(200);
        $response->assertSee('Facilities');
    }

    public function test_admin_can_delete_facility()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $facility = Facility::factory()->create();

        $response = $this->actingAs($admin)->delete('/admin/facilities/'.$facility->id);

        $response->assertRedirect();
        $this->assertDatabaseMissing('facilities', ['id' => $facility->id]);
    }

    public function test_non_admin_cannot_manage_facilities()
    {
        $user = User::factory()->create(['role' => 'parent']);

        $response = $this->actingAs($user)->get('/admin/facilities');
        $response->assertStatus(403);
    }
}
