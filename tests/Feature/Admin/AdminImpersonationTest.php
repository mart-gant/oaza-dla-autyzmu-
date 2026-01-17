<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group admin
 */
class AdminImpersonationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_impersonate_and_return()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create();

        $this->actingAs($admin)->post('/admin/users/'.$user->id.'/impersonate');

        $this->assertAuthenticated();
        $this->assertEquals($user->id, auth()->id());
        $this->assertNotNull(session('impersonator_id'));

        $this->get('/admin/stop-impersonate');

        $this->assertAuthenticated();
        $this->assertEquals($admin->id, auth()->id());
    }

    public function test_non_admin_cannot_impersonate()
    {
        $user = User::factory()->create(['role' => 'parent']);
        $target = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/users/'.$target->id.'/impersonate');
        $response->assertStatus(403);
    }
}
