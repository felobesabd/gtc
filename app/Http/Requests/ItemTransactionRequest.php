<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemTransactionRequest extends FormRequest
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
            'quantity' => 'required|numeric|min:1',
            'reason' => 'nullable|string',
            'transaction_type' => 'required|integer',
            'supplier_id' => 'nullable|integer|exists:suppliers,id',
            'user_id' => 'required|integer|exists:users,id',
            'cost' => 'required|numeric|min:1',
        ];
    }
}
