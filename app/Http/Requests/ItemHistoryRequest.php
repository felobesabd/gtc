<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemHistoryRequest extends FormRequest
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
            'item_id' => 'required|exists:item_categories,id',
            'quantity_out' => 'required|numeric|min:1',
            'reason_out' => 'nullable|string',
            'supply_order_no' => 'required|string',
            'cost' => 'required|numeric|min:1',
        ];
    }
}
