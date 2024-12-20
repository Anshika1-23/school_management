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
        Schema::create('staff_document', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id');
            $table->string('resume')->nullable();
            $table->string('join_letter')->nullable();
            $table->string('other_doc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_document');
    }
};
