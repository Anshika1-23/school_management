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
        Schema::create('parents_details', function (Blueprint $table) {
            $table->id();
            $table->string('father_img')->nullable();
            $table->string('father_name');
            $table->string('f_occupation')->nullable();
            $table->string('father_phoneNumber')->nullable();
            $table->string('mother_img')->null;
            $table->string('mother_name');
            $table->string('m_occupation')->nullable();
            $table->string('mother_phoneNumber')->nullable();
            $table->string('guardian_relation');
            $table->string('guardian_name');
            $table->string('guardian_email');
            $table->string('guardian_password');
            $table->string('guardian_img')->null;
            $table->string('guardian_phone')->nullable();
            $table->string('guardian_occupation')->nullable();
            $table->string('guardian_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents_details');
    }
};
