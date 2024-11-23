<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentAttachment extends Model
{
    use HasFactory;

    protected $table = 'doc_attachment';

    protected $fillable = [
        'std_id',
        'document_title',
        'document_file',
    ];
}
