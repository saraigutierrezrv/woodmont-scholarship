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
        Schema::create('meeting_student', function (Blueprint $table) {
            $table->id();

            // This links the Meeting and the Student
            $table->foreignId('meeting_id')->constrained()->cascadeOnDelete();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            
            // These are your 3 checkboxes from Excel!
            $table->boolean('attended')->default(false);
            $table->boolean('grades_submitted')->default(false);
            $table->boolean('letter_submitted')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_student');
    }
};
