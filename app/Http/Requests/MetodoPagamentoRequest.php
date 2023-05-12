<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MetodoPagamentoRequest extends FormRequest
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
            'name' => 'required|max: 45'
            /*'estado_id' => 'required|integer'
            'modelo' => 'required|max:50',
            'ano' => 'required|integer|min:1900',
            'km' => 'required|integer',
            'placa' => 'required|max:7'*/
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome do método de pagt é obrigatório',
            'name.max' => 'O nome do pagt está limitado à no máx 45 caracteres'

            /*'estado_id.required' => 'O ID da cidade é obrigatório',
            'estado_id.integer' => 'O estado deve ser inteiro'      

            'modelo.required' => 'Mdelo é obrigatório',
            'modelo.max' => 'modelo máximo 50 caracteres',

            'ano.min' => 'Ano deve ser maior que 1900',
            'ano.integer' => 'Ano deve ser um número inteiro',
            'ano.required' => 'Ano é obrigatórip',

            'km.integer' => 'Km deve ser inteiro',
            'km.required' => 'Km é obrigatório',

            'placa.required' => 'Placa é obrigatório',
            'placa.max' => 'Placa maximo de 7 caracteres'*/
        ];
    }
}
