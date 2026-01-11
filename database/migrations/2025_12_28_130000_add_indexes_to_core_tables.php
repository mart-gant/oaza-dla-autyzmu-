<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->index('role', 'users_role_index');
        });

        if (Schema::hasTable('audit_logs')) {
            Schema::table('audit_logs', function (Blueprint $table) {
                $table->index('user_id', 'audit_logs_user_id_index');
                $table->index('created_at', 'audit_logs_created_at_index');
                $table->index(['target_type', 'target_id'], 'audit_logs_target_index');
                $table->index('action', 'audit_logs_action_index');
            });
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('users_role_index');
        });

        if (Schema::hasTable('audit_logs')) {
            Schema::table('audit_logs', function (Blueprint $table) {
                $table->dropIndex('audit_logs_user_id_index');
                $table->dropIndex('audit_logs_created_at_index');
                $table->dropIndex('audit_logs_target_index');
                $table->dropIndex('audit_logs_action_index');
            });
        }
    }
};
