<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarcaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max: 45',
            'fornecedor_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome do fornecedor é obrigatório',
            'name.max' => 'Máximo 45 caracteres no nome do fornecedor',

            'fornecedor_id.integer' => 'Fornecedor deve ser inteiro',
            'fornecedor_id.required' => 'Fornecedor é obrigatório',
        ];
    }
}
