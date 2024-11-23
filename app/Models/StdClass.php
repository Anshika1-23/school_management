<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StdClass extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'title',
        'section',
        'status',
    ];

    public function class_section(){
        return $this->hasOne(Section::class,'id','title');
    }
}
