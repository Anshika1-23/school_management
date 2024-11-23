<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentDetail extends Model
{
    use HasFactory;

    protected $table = 'parents_details';

    protected $fillable = [
        'father_img',
        'father_name',
        'f_occupation',
        'father_phoneNumber',
        'mother_img',
        'mother_name',
        'm_occupation',
        'mother_phoneNumber',
        'guardian_relation',
        'guardian_name',
        'guardian_email',
        'guardian_password',
        'guardian_img',
        'guardian_phone',
        'guardian_occupation',
        'guardian_address',
    ];

    public function student_name(){
        return $this->hasMany(Student::class,'parent_id','id')->with('class_name','section_name','blood_name','religion_name');
    }
}
