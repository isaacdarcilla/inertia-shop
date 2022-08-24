<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'item_name' => 'required|min:3|max:50',
            'item_price' => 'required|numeric',
            'item_category' => 'required|max:50',
            'item_description' => 'required|min:3|max:255',
        ];
    }
}
