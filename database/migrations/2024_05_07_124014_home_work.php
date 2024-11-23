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
        Schema::create('home_work', function (Blueprint $table) {
            $table->id();
            $table->string('class_id')->nullable();
            $table->string('section_id')->nullable();
            $table->string('subject_id')->nullable();
            $table->string('homework_date')->nullable();
            $table->string('submission_date')->nullable();
            $table->string('evaluation_date')->nullable();
            $table->string('file')->nullable();
            $table->string('marks')->nullable();
            $table->text('description')->nullable();
            $table->integer('created_by')->nullable();
            $table->boolean('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_work');
    }
};
