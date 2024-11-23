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
        Schema::create('apply_leaves', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id')->nullable();
            $table->string('role_id')->nullable();
            $table->date('apply_date')->nullable();
            $table->date('leave_from')->nullable();
            $table->date('leave_to')->nullable();
            $table->string('type_id')->nullable();
            $table->string('define_id')->nullable();
            $table->text('reason')->nullable();
            $table->string('approve_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apply_leaves');
    }
};
