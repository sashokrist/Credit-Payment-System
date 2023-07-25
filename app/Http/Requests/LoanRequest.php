<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'borrower_name' => 'required',
            'amount' => 'required|numeric|min:1|max:80000', // Enforce amount range from 1 to 1,000,000
            'term' => 'required|integer|min:3|max:120', // Enforce term range from 3 to 120 months
        ];
    }
}
