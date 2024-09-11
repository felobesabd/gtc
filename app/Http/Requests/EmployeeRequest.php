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
            'country' => ['required', 'string'],
            'department_id' => ['required', 'integer'],
            'bank_name' => ['required', 'string'],
            'bank_acc_no' => ['required', 'string'],
            'civil_no' => ['required', 'string'],
            'date_of_birth' => ['required'],
            'joining_date' => ['required'],
            'passport_no' => ['required', 'string'],
            'attachments' => ['nullable', 'array', 'max:5'],
//            'attachments.*' => ['nullable', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ];
    }
}

//'personal_card_image' => ['string'],
//            'passport_image' => ['string'],
