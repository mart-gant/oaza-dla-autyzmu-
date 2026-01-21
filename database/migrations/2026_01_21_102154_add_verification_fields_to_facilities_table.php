<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->string('source')->nullable()->after('is_verified')->comment('Źródło danych: Lista Idy Tyminy, Certyfikat DwS, itp.');
            $table->enum('verification_status', ['unverified', 'verified', 'certified', 'flagged'])->default('unverified')->after('source')->comment('Status weryfikacji placówki');
            $table->foreignId('verified_by')->nullable()->after('verification_status')->constrained('users')->nullOnDelete()->comment('Admin który zweryfikował');
            $table->timestamp('verified_at')->nullable()->after('verified_by')->comment('Data weryfikacji');
            $table->text('verification_notes')->nullable()->after('verified_at')->comment('Notatki dotyczące weryfikacji');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->dropForeign(['verified_by']);
            $table->dropColumn(['source', 'verification_status', 'verified_by', 'verified_at', 'verification_notes']);
        });
    }
};
