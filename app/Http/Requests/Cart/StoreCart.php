<?php

namespace App\Http\Requests\Cart;

use App\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreCart extends FormRequest
{
    use ApiResponseTrait;
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
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
       return $this->ValidationErrors($validator);

    }
}
