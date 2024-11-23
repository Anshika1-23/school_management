<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Staff;

class StaffPayroll extends Model
{
    use HasFactory;

    protected $table = 'staff_payroll';

    public function staff_name(){
        return $this->hasOne(Staff::class,'id','staff_id')->with('role_name','department_name','designation_name');
    }

    public function payment(){
        return $this->hasOne(PayrollPayment::class,'payroll_id','id');
    }
}
