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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enrolled_student_id');
            $table->unsignedBigInteger('assessment_id')->nullable();
            $table->string('points')->nullable();
            $table->integer('fg_grade')->nullable();
            $table->integer('midterms_grade')->nullable();
            $table->integer('finals_grade')->nullable();
            $table->integer('adjusted_finals_grade')->nullable();
            $table->boolean('published')->default(false);
            $table->boolean('published_midterms')->default(false)->nullable();
            $table->boolean('published_finals')->default(false)->nullable();
            $table->string('status')->nullable();
            $table->string('midterms_status')->nullable();
            $table->string('finals_status')->nullable();
            $table->timestamps();

            $table->foreign('enrolled_student_id')->references('id')->on('enrolled_students');
            $table->foreign('assessment_id')->references('id')->on('assessments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
