<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
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
            'chassis_no' => ['required', 'string'],
            'machine_no' => ['required', 'string'],
            'gearbox_no' => ['required', 'string'],
            'vehicle_type' => ['required', 'string'],
            'license_no' => ['required', 'string'],
            'plate_no' => ['required', 'string'],
            'color' => ['required', 'string'],
            'capacity' => ['required', 'integer'],
            'category_id' => ['required', 'integer'],
            'group_id' => ['required', 'integer'],
        ];
    }
}
