<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // DB::table('admin')->insert([
        //     'admin_name' => 'Site Admin',
        //     'admin_email' => 'admin@example.com',
        //     'username' => 'admin',
        //     'password' => Hash::make('123456'),
        //     'admin_phone' => '9999999999',
        // ]);

        // $faker = Faker::create();
        // foreach (range(1,5) as $index) {
        // DB::table('parent_details')->insert([
        //     'father_img' => 'http://lorempixel.com',
        //     'father_name' => $faker->firstNameMale,
        //     'f_occupation' => 'null',
        //     'father_phoneNumber' => $faker->tollFreePhoneNumber,
        //     'mother_img' => 'http://lorempixel.com',
        //     'mother_name' => $faker->firstNameFemale,
        //     'm_occupation' => 'null',
        //     'mother_phoneNumber' => $faker->tollFreePhoneNumber,
        //     'guardian_relation' => 'mother',
        //     'guardian_name' => $faker->name,
        //     'guardian_email' =>  $faker->freeEmail,
        //     'guardian_password' => Hash::make('123456'),
        //     'guardian_img' => 'http://lorempixel.com',
        //     'guardian_phone' =>$faker->phoneNumber ,
        //     'guardian_occupation' => 'null',
        //     'guardian_address' => $faker->address,
        // ]);

        // DB::table('students')->insert([
        //     'admission_no' => $faker->randomDigit,
        //     'roll_no' => $faker->randomDigit,
        //     'first_name' => $faker->name,
        //     'last_name' => $faker->lastName,
        //     'date_of_birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
        //     'caste' => 'general',
        //     'email' =>  $faker->freeEmail,
        //     'password' => Hash::make('123456'),
        //     'phone' => $faker->phoneNumber ,
        //     'admission_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        //     'student_photo' => 'http://lorempixel.com',
        //     'height' => 'null',
        //     'weight' => 'null',
        //     'current_address' => $faker->address,
        //     'permanent_address' => $faker->address,
        //     'status' => '1',
        //     'parent_id' =>  $faker->randomDigit,
        //     'bloodgroup_id' =>  $faker->randomDigit,
        //     'religion_id' => $faker->randomDigit,
        //     'student_category_id' => $faker->randomDigit,
        //     'class_id' => $faker->randomDigit,
        //     'section_id' => $faker->randomDigit,
        //     'session_id' => $faker->randomDigit,
        //     'gender' => $faker->name($gender = 'male'|'female'), 
        //     'academic_id' => $faker->randomDigit,
        //     'pre_scl_detail' => $faker->text,
        // ]);

        // DB::table('document_info')->insert([
        //     'national_id_no' => $faker->nationalIdNumber,
        //     'national_doc' => 'null',
        //     'birth_certificate_no' => $faker->birthNumber,
        //     'birth_doc' => 'null',
        //     'std_id' => $faker->randomDigit,
        // ]);

        // DB::table('bank_info')->insert([
        //     'bank_name' => $faker->bank,
        //     'bank_account_number' =>$faker->bankAccountNumber,
        //     'ifsc_code' => 'null',
        //     'std_id' => $faker->randomDigit,
        // ]);
    
        // }
    
     }
}
