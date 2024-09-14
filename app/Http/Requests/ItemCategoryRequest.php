<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemCategoryRequest extends FormRequest
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
            'item_name' => ['required', 'string'],
            'part_no' => ['required', 'string'],
            'category_id' => ['required', 'integer'],
            'group_id' => ['required', 'integer'],
            'unit_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
//            'rate' => ['required','integer'],
            'min_allowed_value' => ['required','integer'],
        ];
    }
}
