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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('img')->null;
            $table->string('f_name');
            $table->string('l_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('role');
            $table->string('department');
            $table->string('designation');
            $table->string('email');
            $table->string('password');
            $table->string('gender');
            $table->string('dob');
            $table->string('date_of_joining');
            $table->string('mobile');
            $table->string('emergency_mobile');
            $table->string('driving_license')->null;
            $table->text('address');
            $table->text('permanent_address');
            $table->text('qualification');
            $table->text('experience');
            $table->tinyInteger('marital_status')->default('0');
            $table->tinyInteger('login_permission')->default('0');
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
