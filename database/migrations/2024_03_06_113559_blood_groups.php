<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blood_groups', function (Blueprint $table) {
            $table->id();
            $table->string('title',200);
            $table->timestamps();
        });

        DB::table('blood_groups')->insert([
            ['title' => 'A+'],
            ['title' => 'A-'],
            ['title' => 'B+'],
            ['title' => 'B-'],
            ['title' => 'O-'],
            ['title' => 'O+'],
            ['title' => 'AB+'],
            ['title' => 'AB-'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_groups');
    }
};
