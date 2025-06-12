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
        Schema::create('point_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->enum('type', ["INC", "DEC"]);
            $table->enum('category', ["ROOT", "SOL", "PRE", "NOTE"]);
            $table->integer('point_before');
            $table->integer('point_earned');
            $table->integer('point_after');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_histories');
    }
};
