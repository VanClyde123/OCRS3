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
        Schema::create('assessment_views', function (Blueprint $table) {
           $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('assessment_id');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assessment_id')->references('id')->on('assessments')->onDelete('cascade');

            $table->unique(['student_id', 'assessment_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_views');
    }
};
