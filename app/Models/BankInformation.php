<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankInformation extends Model
{
    use HasFactory;

    protected $table = 'parents_details';

    protected $fillable = [
        'std_id',
        'bank_name',
        'bank_account_number',
        'ifsc_code',
    ];
}
