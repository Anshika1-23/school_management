<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StaffBankInfo;
use App\Models\StaffDocument;
use App\Models\StaffPayroll;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staffs';

    protected $fillable = [
        'f_name',
        'l_name',
        'father_name',
        'mother_name',
        'role',
        'department',
        'designation',
        'email',
        'password',
        'gender',
        'dob',
        'date_of_joining',
        'mobile',
        'emergency_mobile',
        'driving_license',
        'address',
        'permanent_address',
        'qualification',
        'experience',
        'marital_status',
        'status',
    ];

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['f_name'] . ' ' . $attributes['l_name']
        );
    }

    public function role_name(){
        return $this->hasOne(Role::class,'id','role');
    }

    public function department_name(){
        return $this->hasOne(Department::class,'id','department');
    }

    public function designation_name(){
        return $this->hasOne(Designation::class,'id','designation');
    }

    public function bank_info(){
        return $this->hasOne(StaffBankInfo::class,'staff_id','id');
    }

    public function doc_info(){
        return $this->hasOne(StaffDocument::class,'staff_id','id');
    }

    public function payroll(){
        return $this->hasOne(StaffPayroll::class,'staff_id','id');
    }
}
