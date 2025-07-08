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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained("genba_sessions")->onDelete("cascade");
            $table->foreignId('line_id')->constrained("lines")->onDelete("cascade");
            $table->text('items');
            $table->text('assigned_ids');
            $table->text('description');
            $table->enum('status', ["OPEN", "CLOSED"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
