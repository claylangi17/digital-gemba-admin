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
        Schema::table('actions', function (Blueprint $table) {
            $table->index('status', 'idx_actions_status');
        });

        Schema::table('issues', function (Blueprint $table) {
            $table->index('status', 'idx_issues_status');
        });

        Schema::table('genba_sessions', function (Blueprint $table) {
            $table->index('status', 'idx_genba_sessions_status');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index('name', 'idx_users_name');
        });

        Schema::table('point_histories', function (Blueprint $table) {
            $table->index('created_at', 'idx_point_histories_created_at');
            $table->index(['userid', 'created_at'], 'idx_point_histories_user_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('actions', function (Blueprint $table) {
            $table->dropIndex('idx_actions_status');
        });

        Schema::table('issues', function (Blueprint $table) {
            $table->dropIndex('idx_issues_status');
        });

        Schema::table('genba_sessions', function (Blueprint $table) {
            $table->dropIndex('idx_genba_sessions_status');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('idx_users_name');
        });

        Schema::table('point_histories', function (Blueprint $table) {
             $table->dropIndex('idx_point_histories_user_date');
             $table->dropIndex('idx_point_histories_created_at');
        });
    }
};
