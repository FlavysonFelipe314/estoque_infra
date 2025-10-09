<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFornecedorRequest extends FormRequest
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
            'cnpj' => 'required|string',
            'razao_social' => 'required|string|',
            'email' => 'nullable|email|max:255',
            'telefone' => 'nullable|string|max:11',
            'representante' => 'nullable|string|max:255',
        ];
    }
}
