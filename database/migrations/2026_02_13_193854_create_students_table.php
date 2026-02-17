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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            // Basic Info
            $table->string('full_name');
            $table->date('birth_date'); // We calculate Age from this
            $table->string('mobile_number');
            $table->string('grade'); // e.g., "11th Grade" or "Bachillerato"
            $table->string('location'); // Where they live
            
            // Guardian Info
            $table->string('guardian_name');
            $table->string('guardian_id_number'); // The legal ID (DUI/Cedula)
            
            // Scholarship Info
            $table->decimal('scholarship_amount', 10, 2); // Stores money like 150.00

            $table->timestamps(); // Creates created_at and updated_at automatically
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
