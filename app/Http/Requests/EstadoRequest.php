<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstadoRequest extends FormRequest
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
            'name_state' => 'required|max: 45',
            'pais_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name_state.required' => 'Nome do Estado é obrigatório',
            'name_state.max' => 'Máximo de 45 caracteres no nome do estado',

            'pais_id.integer' => 'Id do país deve ser inteiro',
            'pais_id.required' => 'País é obrigatório',
        ];
    }
}
