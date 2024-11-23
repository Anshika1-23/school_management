<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';

    protected $fillable = [
        'title',
        'status',
    ];

    public function getClass(){
        return $this->belongsTo(stdClass::class, 'id');
    }
}
