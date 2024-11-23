<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeWork extends Model
{
    use HasFactory;

    protected $table = 'home_work';

    protected $fillable = [
        'class_id',
        'section_id',
        'subject_id',
        'homework_date',
        'submission_date',
        'file',
        'marks',
        'description',
        'created_by',
        'status',
    ];

    public function class_name(){
        return $this->hasOne(StdClass::class,'id','class_id');
    }

    public function section_name(){
        return $this->hasOne(Section::class,'id','section_id');
    }

    public function subject_name(){
        return $this->hasOne(Subject::class,'id','subject_id');
    }
}
