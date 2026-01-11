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
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type'); // 'like', 'dislike', 'heart', etc.
            $table->morphs('reactable'); // reactable_id, reactable_type
            $table->timestamps();
            
            // Użytkownik może dać tylko jedną reakcję na dany obiekt
            $table->unique(['user_id', 'reactable_id', 'reactable_type']);
            $table->index(['reactable_id', 'reactable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reactions');
    }
};
