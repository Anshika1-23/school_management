<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FeesGroup;

class FeesType extends Model
{
    use HasFactory;

    public function group_name(){
        return $this->hasOne(FeesGroup::class,'id','group');
    }
}
