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
        Schema::create('document_info', function (Blueprint $table) {
            $table->id();
            $table->string('national_id_no')->nullable();
            $table->string('national_doc', 200)->nullable();
            $table->string('birth_certificate_no')->nullable();
            $table->string('birth_doc', 200)->nullable();
            $table->string('std_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_info');
    }
};
