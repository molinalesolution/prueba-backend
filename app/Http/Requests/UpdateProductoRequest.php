<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'currency_id' => 'sometimes|required|exists:divisas,id',
            'tax_cost' => 'sometimes|required|numeric|min:0',
            'manufacturing_cost' => 'sometimes|required|numeric|min:0',
        ];
    }
}
