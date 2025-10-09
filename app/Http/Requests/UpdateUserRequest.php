<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'cpf' => 'required|string|size:11',
            'telefone' => 'nullable|string|max:11',
            'cargo' => 'nullable|string',
            'setor' => 'nullable|string',
            'matricula' => 'nullable|string',
            'acesso' => 'required|string',
        ];
    }
}
