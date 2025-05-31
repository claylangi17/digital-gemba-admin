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
        Schema::create('genba_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('whiteboard_id')->default('');
            $table->enum('status', ['PROGRESS', 'POSTPONE', 'FINISH'])->default('PROGRESS');
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genba_sessions');
    }
};
