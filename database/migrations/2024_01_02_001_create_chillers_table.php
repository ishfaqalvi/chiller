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
        Schema::create('chillers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model');
            $table->integer('chiller_maximum_capacity');
            $table->integer('chiller_minimum_capacity');
            $table->integer('chilled_water_flow');
            $table->integer('partial_load_25');
            $table->integer('partial_load_50');
            $table->integer('partial_load_75');
            $table->integer('partial_load_100');
            $table->foreignId('customer_id')->nullable()->references('id')->on('customers');
            $table->enum('status',['Pending','Approved','Disabled'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chillers');
    }
};
