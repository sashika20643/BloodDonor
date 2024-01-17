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
        Schema::create('blood_camp_donors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bloodCamp_id')->constrained('blood_camps');
            $table->foreignId('user_id')->constrained('users');
            $table->enum('status', ['donated', 'pending', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_camp_donors');
    }
};
