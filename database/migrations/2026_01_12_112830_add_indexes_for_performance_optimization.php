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
        // Indexy dla facilities - często wyszukiwane po mieście i nazwie
        Schema::table('facilities', function (Blueprint $table) {
            $table->index('city');
            $table->index('name');
            $table->index('is_verified');
            $table->index(['city', 'is_verified']); // Composite index
        });

        // Indexy dla forum_topics - sortowanie i wyszukiwanie
        Schema::table('forum_topics', function (Blueprint $table) {
            $table->index('created_at');
            $table->index(['forum_category_id', 'created_at']);
        });

        // Indexy dla forum_posts - relacje i sortowanie
        Schema::table('forum_posts', function (Blueprint $table) {
            $table->index('created_at');
            $table->index(['forum_topic_id', 'created_at']);
        });

        // Indexy dla reviews - rating i daty
        Schema::table('reviews', function (Blueprint $table) {
            $table->index('rating');
            $table->index(['facility_id', 'created_at']);
        });

        // Indexy dla messages - konwersacje
        Schema::table('messages', function (Blueprint $table) {
            $table->index('is_read');
            $table->index(['sender_id', 'receiver_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->dropIndex(['city']);
            $table->dropIndex(['name']);
            $table->dropIndex(['is_verified']);
            $table->dropIndex(['city', 'is_verified']);
        });

        Schema::table('forum_topics', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['forum_category_id', 'created_at']);
        });

        Schema::table('forum_posts', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['forum_topic_id', 'created_at']);
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropIndex(['rating']);
            $table->dropIndex(['facility_id', 'created_at']);
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->dropIndex(['is_read']);
            $table->dropIndex(['sender_id', 'receiver_id', 'created_at']);
        });
    }
};
