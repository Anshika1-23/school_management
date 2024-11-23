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
        Schema::create('fees_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('student');
            $table->integer('class');
            $table->integer('section');
            $table->integer('type_id');
            $table->integer('group_id');
            $table->integer('amount');
            $table->integer('waiver');
            $table->boolean('status');
            $table->string('payment_date')->nullable();
            $table->string('pay_method')->nullable();
            $table->string('due_date');
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees_invoices');
    }
};
