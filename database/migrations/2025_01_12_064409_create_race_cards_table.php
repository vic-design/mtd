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
        Schema::create('race_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('model_id')->constrained('models')->onDelete('cascade');
            $table->foreignId('engine_id')->constrained('engines')->onDelete('cascade');
            $table->unsignedInteger('hp')->nullable();
            $table->unsignedInteger('speed')->nullable();
            $table->unsignedInteger('dr')->nullable();
            $table->unsignedInteger('hp_tuned')->nullable();
            $table->unsignedInteger('speed_tuned')->nullable();
            $table->unsignedInteger('dr_tuned')->nullable();
            $table->unsignedInteger('one_eight')->nullable();
            $table->unsignedInteger('one_fourth')->nullable();
            $table->unsignedInteger('one_second')->nullable();
            $table->unsignedInteger('one')->nullable();
            $table->float('result')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('race_cards');
    }
};
