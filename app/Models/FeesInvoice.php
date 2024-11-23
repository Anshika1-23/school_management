<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\StdClass;
use App\Models\Section;
use App\Models\FeesType;
use App\Models\FeesGroup;

class FeesInvoice extends Model
{
    use HasFactory;

    public function student_name(){
        return $this->hasOne(Student::class,'id','student');
    }

    public function student_details(){
        return $this->hasOne(Student::class,'id','student')->with('class_name:id,title','section_name:id,title');
    }

    public function class_name(){
        return $this->hasOne(StdClass::class,'id','class');
    }
    
    public function section_name(){
        return $this->hasOne(Section::class,'id','section');
    }
    
    public function type_name(){
        return $this->hasOne(FeesType::class,'id','type_id');
    }
    
    public function group_name(){
        return $this->hasOne(FeesGroup::class,'id','group_id');
    }
}
