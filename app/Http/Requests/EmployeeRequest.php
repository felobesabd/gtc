<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'direct_contact_number' => ['required', 'string'],
            'whatsapp_number' => ['required', 'string'],
            'social_url' => ['nullable', 'string'],
            'country' => ['nullable', 'string'],
            'country_contact_number' => ['required', 'string'],
            'country_code' => ['required', 'string'],
            'date_of_birth' => ['required'],
            'joining_date' => ['required'],
            'department_id' => ['required', 'integer'],
            'passport_no' => ['required', 'string'],
            'civil_no' => ['required', 'string'],
            'bank_name' => ['required', 'string'],
            'bank_acc_no' => ['nullable', 'string'],
            'driving_license_expires_at' => ['required'],
            'driving_license_issued_at' => ['required'],
            'passport_issued_at' => ['required'],
            'passport_expires_at' => ['required'],
            'attachments' => ['nullable', 'array', 'max:5'],
            'attachments.*' => ['nullable', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ];
    }
}

//'personal_card_image' => ['string'],
//            'passport_image' => ['string'],
