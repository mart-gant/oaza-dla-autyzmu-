<?php

namespace Tests\Feature\Admin;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group admin
 */
class AdminAuditLogTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_audit_logs()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        AuditLog::create(['user_id' => $admin->id, 'action' => 'test_action', 'target_type' => 'user', 'target_id' => $admin->id]);

        $response = $this->actingAs($admin)->get('/admin/audit-logs');
        $response->assertStatus(200);
        $response->assertSee('test_action');
    }

    public function test_non_admin_cannot_view_audit_logs()
    {
        $user = User::factory()->create(['role' => 'parent']);
        $response = $this->actingAs($user)->get('/admin/audit-logs');
        $response->assertStatus(403);
    }
}
