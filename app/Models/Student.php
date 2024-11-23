<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Student extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'students';

    protected $fillable = [
        'admission_no',
        'class',
        'section',
        'admission_number',
        'admission_date',
        'std_img',
        'f_name',
        'l_name',
        'gender',
        'dob',
        'religion',
        'caste',
        'email',
        'password',
        'blood_group',
        'std_category',
        'height',
        'weight',
        'address',
        'permanent_address',
        'national_id_card',
        'birth_certificate_number',
        'status',
    ];

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['first_name'] . ' ' . $attributes['last_name']
        );
    }

    // public function assignClass_name(){
    //     return $this->hasOne(AssignClassTeacher::class,'id','class_id');
    // }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function class_name(){
        return $this->hasOne(StdClass::class,'id','class_id');
    }

    public function section_name(){
        return $this->hasOne(Section::class,'id','section_id');
    }

    public function blood_name(){
        return $this->hasOne(BloodGroups::class,'id','bloodgroup_id');
    }

    public function religion_name(){
        return $this->hasOne(Religion::class,'id','religion_id');
    }

    public function parent_name(){
        return $this->hasOne(ParentDetail::class,'id','parent_id');
    }

    public function bank_name(){
        return $this->hasOne(BankInfo::class,'std_id','id');
    }

    public function document_name(){
        return $this->hasOne(DocumentInfo::class,'std_id','id');
    }

    public function apply_leave(){
        return $this->hasOne(StdApplyLeave::class,'student_id','id');
    }

    public function staff_name(){
        return $this->hasOne(Staff::class,'id','parent_id')->with('designation_name');
    }

    public function category_name(){
        return $this->hasOne(StudentCategory::class,'id','student_category_id');
    }

    public function fees_detail(){
        return $this->hasMany(FeesInvoice::class,'student','id')->with('type_name:id,title','group_name:id,title');
    }
}
