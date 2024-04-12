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
         Schema::create('assessment_descriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_desc_id');
            $table->string('grading_period');
            $table->string('type');
            $table->string('description');
            $table->timestamps();

            $table->foreign('subject_desc_id')->references('id')->on('subject_descriptions');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_descriptions');
    }
};
