<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCardEmployees extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_card_id', 'estimated_time_employee', 'employee_id',
    ];
}
