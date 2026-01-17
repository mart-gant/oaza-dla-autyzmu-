<?php

namespace Tests\Feature\Admin;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @group admin
 */
class AdminAuditLogExportTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_export_audit_logs_csv()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        AuditLog::create(['user_id' => $admin->id, 'action' => 'export_test', 'target_type' => 'user', 'target_id' => $admin->id]);

        $response = $this->actingAs($admin)->get('/admin/audit-logs/export');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
        $this->assertStringContainsString('export_test', $response->getContent());
    }
}
