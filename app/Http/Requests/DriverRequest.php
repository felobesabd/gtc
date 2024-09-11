<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
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
            'phone_number' => ['required', 'string'],
            'age' => ['required', 'string'],
            'date_of_birth' => ['required'],
            'passport_no' => ['required', 'string'],
            'bus_no' => ['required', 'string'],
            'license_no' => ['required', 'string'],
            'license_expired' => ['required'],
            'attachments' => ['nullable', 'array', 'max:5'],
//            'attachments.*' => ['nullable', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ];
    }
}

//'personal_card_image' => ['string'],
//            'passport_image' => ['string'],
