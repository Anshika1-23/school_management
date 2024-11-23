<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class Notice extends Model
{
    use HasFactory;

    protected $table = 'notices';


    public function message_user(){
        return $this->hasOne( Role::class,'id','message_to');
    }
}
