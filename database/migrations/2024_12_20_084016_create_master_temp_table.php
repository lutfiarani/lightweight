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
        Schema::create('master_temp', function (Blueprint $table) {
            $table->id();
            $table->string('development_center', 100);
            $table->string('season', 4);
            $table->string('model_name', 150);
            $table->string('model_number', 5);
            $table->string('article', 6);
            $table->string('development_type', 30);
            $table->string('weight_status', 20);
            $table->string('stage', 10);
            $table->integer('target');
            $table->decimal('AS', 8, 2);
            $table->decimal('UP', 8, 2);
            $table->decimal('SF', 8, 2);
            $table->decimal('OS', 8, 2);
            $table->decimal('MS', 8, 2);
            $table->decimal('sockliner', 8, 2);
            $table->string('article_status', 15);
            $table->string('sports_category', 15);
            $table->string('business_segment', 25);
            $table->string('gender', 10);
            $table->string('age_group', 25);
            $table->string('sample_size', 5);
            $table->string('article_latest', 10);
            $table->string('article_master', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_temp');
    }
};
