<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobCardRequest extends FormRequest
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
            'vehicle_id' => 'required|integer',
            'delivered_by' => 'required|string|max:255',
            'received_by' => 'required|string|max:255',
            'ref_number' => 'required|string|max:255',
            'date_in' => 'required|date',
            'expected_date_out' => 'nullable|date',
            'reg_no' => 'required|string|max:255',
            'km' => 'required|integer',
            'expected_hour_out' => 'nullable|integer',
            'location' => 'required|string|max:255',
            'site' => 'required|integer',
            'job_card_type' => 'required|array',
            'job_card_type.*' => 'integer|in:1,2,3,4,5',
            'repair_type' => 'required|array',
            'repair_type.*' => 'integer|in:1,2,3,4,5,6,7',
            'work_required' => 'nullable|string',
            'estimated_time' => 'nullable|string|max:255',
//            'staff_details' => 'nullable|string',
            'staff_details' => 'required|array',
            'staff_details.*' => 'integer',
            'comments' => 'nullable|string',
            'lubrication_cost' => 'nullable|numeric',
            'subcontractor_cost' => 'nullable|numeric',
            'parts_cost' => 'nullable|numeric',
            'total_cost' => 'nullable|numeric',
            'operation_coordinator' => 'nullable|string',
            'maintenance_supervisor' => 'nullable|string',
            'maintenance_manager' => 'nullable|string',
            'driver_id' => 'required|integer',
        ];
    }
}
