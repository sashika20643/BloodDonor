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
        Schema::create('blood_camps', function (Blueprint $table) {
            $table->id();
            $table->string('organisation_name');
            $table->string('address');
            $table->string('email');
            $table->string('name');
            $table->string('phone_number');
            $table->date('validity');
            $table->unsignedInteger('number_of_donors');
            $table->text('target_address');
            $table->string('target_location');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('image')->nullable();
            $table->enum('status', ['Pending', 'Active', 'Completed'])->default('Pending');
            $table->foreignId('doctor_id')->constrained('doctors'); // Assuming doctors table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_camps');
    }
};
