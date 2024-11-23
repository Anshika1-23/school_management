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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('admission_no')->nullable();
            $table->integer('roll_no')->nullable();
            $table->string('first_name', 200)->nullable();
            $table->string('last_name', 200)->nullable();
            $table->date('date_of_birth')->nullable();

            $table->string('caste', 200)->nullable();
            $table->string('email', 200);
            $table->string('password');
            $table->string('phone', 200)->nullable();
            $table->date('admission_date')->nullable();
            $table->string('student_photo')->nullable();

            $table->string('age', 200)->nullable();
            $table->string('height', 200)->nullable();
            $table->string('weight', 200)->nullable();
            $table->string('current_address', 500)->nullable();
            $table->string('permanent_address', 500)->nullable();

            // $table->string('national_id_no', 200)->nullable();
            // $table->string('bank_account_no', 200)->nullable();
            // $table->string('bank_name', 200)->nullable();
            // $table->string('previous_school_details', 500)->nullable();
            // $table->text('aditional_notes')->nullable();
            // $table->string('ifsc_code', 50)->nullable();

            $table->string('national_id_no')->nullable();
            $table->string('birth_certificate_no')->nullable();
            
            // $table->string('document_title_1', 200)->nullable();
            // $table->string('document_file_1', 200)->nullable();
            // $table->string('document_title_2', 200)->nullable();
            // $table->string('document_file_2', 200)->nullable();
            // $table->string('document_title_3', 200)->nullable();
            // $table->string('document_file_3', 200)->nullable();
            // $table->string('document_title_4', 200)->nullable();
            // $table->string('document_file_4', 200)->nullable();
            $table->tinyInteger('status')->default(1);
           // $table->timestamps();

           $table->integer('parent_id')->nullable()->unsigned();

            $table->integer('bloodgroup_id')->nullable()->unsigned();

            $table->integer('religion_id')->nullable()->unsigned();

            // $table->integer('route_list_id')->nullable()->unsigned();

            // $table->integer('dormitory_id')->nullable()->unsigned();

            // $table->integer('vechile_id')->nullable()->unsigned();

            // $table->integer('room_id')->nullable()->unsigned();

            $table->integer('student_category_id')->nullable()->unsigned();

            // $table->integer('student_group_id')->nullable()->unsigned();

            $table->integer('class_id')->nullable()->unsigned();

            $table->integer('section_id')->nullable()->unsigned();

            $table->integer('session_id')->nullable()->unsigned();

            // $table->integer('parent_id')->nullable()->nullable()->unsigned();

            // $table->integer('user_id')->nullable()->nullable()->unsigned();

            // $table->integer('role_id')->nullable()->unsigned();

            $table->integer('gender')->nullable()->unsigned();


            // $table->integer('school_id')->default(1)->unsigned();
            
            $table->integer('academic_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
