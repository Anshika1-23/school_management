<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveDefine extends Model
{
    use HasFactory;

    protected $table = 'leave_define';

    protected $fillable = [
        'user_id',
        'role',
        'days',
        'leave_type',
        'leave_user',
        'status',
    ];

   public function staff_name(){
      return $this->hasOne(Staff::class,'id','user_id');
   } 

   public function student_name(){
      return $this->hasOne(Student::class,'id','user_id');
   } 

   public function role_name(){
      return $this->hasOne(Role::class,'id','role');
   }

   public function leaveType(){
      return $this->hasOne(LeaveType::class,'id','leave_type');
   }

}
