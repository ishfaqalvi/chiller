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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('job_title');
            $table->string('company');
            $table->string('employees');
            $table->string('mobile_number');
            $table->string('country');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('image')->default('images/profile/avatar.jpg');
            $table->enum('status',['Active','Disable','Block'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};