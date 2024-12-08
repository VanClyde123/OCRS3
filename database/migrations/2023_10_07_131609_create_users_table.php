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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('id_number')->unique();
            $table->string('name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('course')->nullable();
            $table->string('gender')->nullable();
            $table->string('password');
            $table->string('email')->unique();
            $table->tinyInteger('role')->comment('1=admin, 2=teacher, 3=student, 4=secretary');
            $table->tinyInteger('secondary_role')->nullable();
            $table->boolean('password_changed')->default(false);
            $table->boolean('is_active')->default(1); ////1 = actived , 0 - deactivated
            $table->rememberToken();
            $table->timestamps();
            
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamps('created_at');
        });    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
