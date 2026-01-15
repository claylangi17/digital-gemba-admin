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
        Schema::table('items', function (Blueprint $table) {
            $table->index('name', 'idx_items_name');
        });

        Schema::table('genba_sessions', function (Blueprint $table) {
            $table->index('created_at', 'idx_sessions_created_at');
        });

        Schema::table('actions', function (Blueprint $table) {
            $table->index('created_at', 'idx_actions_created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropIndex('idx_items_name');
        });

        Schema::table('genba_sessions', function (Blueprint $table) {
            $table->dropIndex('idx_sessions_created_at');
        });

        Schema::table('actions', function (Blueprint $table) {
            $table->dropIndex('idx_actions_created_at');
        });
    }
};
