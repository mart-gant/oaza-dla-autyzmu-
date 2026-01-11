<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSuspendTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_suspend_and_unsuspend_user()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['is_suspended' => false]);

        $this->actingAs($admin)->post('/admin/users/'.$user->id.'/suspend');
        $this->assertDatabaseHas('users', ['id' => $user->id, 'is_suspended' => 1]);

        $this->actingAs($admin)->post('/admin/users/'.$user->id.'/unsuspend');
        $this->assertDatabaseHas('users', ['id' => $user->id, 'is_suspended' => 0]);
    }

    public function test_non_admin_cannot_suspend()
    {
        $user = User::factory()->create(['role' => 'parent']);
        $target = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/users/'.$target->id.'/suspend');
        $response->assertStatus(403);
    }
}
