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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique()->notNullable();
            $table->enum('type', ['upper_body', 'lower_body', 'core', 'cardio'])->notNullable();
            $table->text('description')->notNullable();
            $table->string('material')->nullable();
            $table->string('video_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
