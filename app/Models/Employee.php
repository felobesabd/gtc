<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id',
        'passport_image',
        'personal_card_image',
        'passport_no',
        'civil_no',
        'bank_acc_no',
        'bank_name',
        'country',
        'joining_date',
        'date_of_birth',
    ];
}
