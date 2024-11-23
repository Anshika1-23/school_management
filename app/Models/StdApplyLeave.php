<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StdApplyLeave extends Model
{
    use HasFactory;

    protected $table = 'std_apply_leaves';

    protected $fillable = [
        'student_id',
        'apply_date',
        'leave_from',
        'leave_to',
        'reason',
        'approve_status',
        'status',
    ];

    public function leave_title(){
        return $this->hasOne(LeaveType::class,'id','type_id');
    }

    public function student_name(){
        return $this->hasOne(Student::class,'id','student_id');
    } 
}
