<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentInfo extends Model
{
    use HasFactory;

    protected $table = 'document_info';

    protected $fillable = [
        'national_id_no',
        'national_doc',
        'birth_certificate_no',
        'birth_doc',
        'std_id',
    ];
}
