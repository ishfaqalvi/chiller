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
        Schema::create('project_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('chiller_id')->constrained()->onDelete('cascade');
            $table->integer('chiller_maximum_capacity');
            $table->integer('chiller_minimum_capacity');
            $table->integer('chilled_water_flow');
            $table->integer('partial_load_25');
            $table->integer('partial_load_50');
            $table->integer('partial_load_75');
            $table->integer('partial_load_100');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_details');
    }
};
