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
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('issue_id')->constrained('issues')->onDelete('cascade');
            $table->foreignId('root_cause_id')->constrained('root_causes')->onDelete('cascade')->nullable();
            $table->enum('type', ['CORRECTIVE', 'PREVENTIVE']);
            $table->text('description')->nullable();
            $table->foreignId('pic_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('due_date')->nullable();
            $table->timestamp('done_at')->nullable();
            $table->enum('status', ['PROGRESS', 'FINISHED']); 
            $table->text('evidence_files')->nullable();
            $table->text('evidence_description')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actions');
    }
};
