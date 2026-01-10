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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('factory_id')->nullable()->constrained('factories')->onDelete('set null');
        });

        Schema::table('lines', function (Blueprint $table) {
            $table->foreignId('factory_id')->nullable()->constrained('factories')->onDelete('set null');
        });

        Schema::table('items', function (Blueprint $table) {
            $table->foreignId('factory_id')->nullable()->constrained('factories')->onDelete('set null');
        });

        Schema::table('genba_sessions', function (Blueprint $table) {
            $table->foreignId('factory_id')->nullable()->constrained('factories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['factory_id']);
            $table->dropColumn('factory_id');
        });

        Schema::table('lines', function (Blueprint $table) {
            $table->dropForeign(['factory_id']);
            $table->dropColumn('factory_id');
        });

        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign(['factory_id']);
            $table->dropColumn('factory_id');
        });

        Schema::table('genba_sessions', function (Blueprint $table) {
            $table->dropForeign(['factory_id']);
            $table->dropColumn('factory_id');
        });
    }
};
