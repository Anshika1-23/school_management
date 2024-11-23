<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('admin_name',20);
            $table->string('username',20);
            $table->string('admin_email',250);
            $table->string('password');
            $table->string('admin_phone');
            $table->timestamps();
        });

        DB::table('admin')->insert([
            'admin_name' => 'Site Admin',
            'username' => 'admin',
            'admin_email' => 'admin@example.com',
            'admin_phone' => '0987654123',
            'password' => Hash::make('123456'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
