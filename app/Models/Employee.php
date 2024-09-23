<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'department_id', 'attachments_ids', 'passport_no', 'civil_no', 'bank_acc_no', 'bank_name',
        'country', 'joining_date', 'date_of_birth', 'passport_issued_at', 'passport_expires_at', 'whatsapp_number',
        'driving_license_issued_at', 'driving_license_expires_at', 'direct_contact_number', 'country_contact_number',
        'country_code', 'email', 'social_url', 'medical_insurance_no', 'medical_issued_at', 'medical_expires_at',
        'life_insurance_no', 'life_issued_at', 'life_expires_at',
    ];

    public function attachment()
    {
        return $this->hasOne(Attachment::class, 'id', 'attachment_id');
    }

    public function getDepartmentName($department_id)
    {
        $department = self::query()
            ->join('departments', 'departments.id', '=', 'employees.department_id')
            ->where('departments.id', $department_id)
            ->value('departments.name_en');

        return $department ?: 'Unknown Department';
    }
}
