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
        Schema::create('student_promotion', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('from_year');
            $table->integer('to_year');
            $table->integer('from_class');
            $table->integer('to_class');
            $table->integer('from_section');
            $table->integer('to_section');
            $table->integer('roll_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_promotion');
    }
};
