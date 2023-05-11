<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BairroRequest extends FormRequest
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
            'name_neighborhood' => 'required|max: 45',
            'cidade_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name_neighborhood.required' => 'O nome do bairro é obrigatório',
            'name_neighborhood.max' => 'Máximo 45 caracteres no nome do bairro',

            'cidade_id.integer' => 'Cidade deve ser inteiro',
            'cidade_id.required' => 'Cidade é obrigatório',
        ];
    }
}
