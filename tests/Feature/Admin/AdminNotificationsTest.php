<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Notifications\RoleChanged;
use App\Notifications\UserSuspended;
use App\Notifications\UserUnsuspended;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class AdminNotificationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_receives_notification_on_role_change()
    {
        Notification::fake();

        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'parent']);

        $this->actingAs($admin)->post(route('admin.users.updateRole', $user), ['role' => 'therapist']);

        Notification::assertSentTo($user, RoleChanged::class);
    }

    public function test_user_receives_notification_on_suspend()
    {
        Notification::fake();

        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'parent']);

        $this->actingAs($admin)->post(route('admin.users.suspend', $user));

        Notification::assertSentTo($user, UserSuspended::class);
    }

    public function test_user_receives_notification_on_unsuspend()
    {
        Notification::fake();

        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'parent', 'is_suspended' => true]);

        $this->actingAs($admin)->post(route('admin.users.unsuspend', $user));

        Notification::assertSentTo($user, UserUnsuspended::class);
    }
}
