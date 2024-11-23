<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Staff;
use App\Models\Subject;

class AssignSubjectTeacher extends Model
{
    use HasFactory;

    protected $table = 'assign_subject_teacher';

    protected $fillable = [
        'class_id',
        'section_id',
        'subject_id',
        'staff_id',
        'status',
    ];

    public function class_name(){
        return $this->hasOne(StdClass::class,'id','class_id');
    }

    public function section_name(){
        return $this->hasOne(Section::class,'id','section_id');
    }

    public function staff_name(){
        return $this->hasOne(Staff::class,'id','staff_id');
    }

    public function subject_name(){
        return $this->hasOne(Subject::class,'id','subject_id');
    }
}
