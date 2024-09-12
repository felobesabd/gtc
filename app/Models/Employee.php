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
        'attachments_ids',
        'passport_no',
        'civil_no',
        'bank_acc_no',
        'bank_name',
        'country',
        'joining_date',
        'date_of_birth',
    ];

    public function getDepartmentName($department_id)
    {
        $department = self::query()
            ->join('departments', 'departments.id', '=', 'employees.department_id')
            ->where('departments.id', $department_id)
            ->value('departments.name_en');

        return $department ?: 'Unknown Department';
    }
}
