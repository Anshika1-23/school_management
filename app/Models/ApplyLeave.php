<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyLeave extends Model
{
    use HasFactory;

    protected $table = 'apply_leaves';

    protected $fillable = [
        'role_id',
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

    public function staff_username(){
        return $this->hasOne(Staff::class,'id','staff_id');
    } 
}
