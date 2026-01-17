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
        Schema::create('strategic_insights', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type'); // PDF Report, Case Study, etc.
            $table->string('category'); // market_data, case_studies, latest
            $table->string('read_time')->nullable();
            $table->string('icon_class')->nullable();
            $table->string('download_url')->nullable();
            $table->string('visibility')->default('public');
            $table->text('body')->nullable(); // For generated content details
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('strategic_insights');
    }
};
