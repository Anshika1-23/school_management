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
        Schema::create('staff_bank_info', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id');
            $table->string('bank_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_num')->nullable();
            $table->string('bank_ifsc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_bank_info');
    }
};
