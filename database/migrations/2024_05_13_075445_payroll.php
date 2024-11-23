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
        Schema::create('staff_payroll', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id');
            $table->string('month');
            $table->integer('year');
            $table->string('basic_salary');
            $table->text('earnings')->nullable();
            $table->text('deductions')->nullable();
            $table->integer('tax')->default('0');
            $table->boolean('status')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_payroll');
    }
};
