<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankInfo extends Model
{
    use HasFactory;

    protected $table = 'bank_info';

    protected $fillable = [
        'bank_name',
        'bank_account_number',
        'ifsc_code',
        'std_id',
    ];
}
