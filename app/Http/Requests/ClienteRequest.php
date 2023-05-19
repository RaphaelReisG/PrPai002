<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'cnpj' => 'required|numeric|max: 99999999999999 | min: 10000000000',
            'company_name' => 'required|max: 45'
            /*'modelo' => 'required|max:50',
            'ano' => 'required|integer|min:1900',
            'km' => 'required|integer',
            'placa' => 'required|max:7'*/
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome do cliente é obrigatório',
            'name.max' => 'O nome do cliente deve ter no máximo 45 caracteres', 

            'company_name.required' => 'O nome da empresa não poe estar em branco',
            'company_name.max' => 'Máximo de 45 caracteres no nome da empresa',

            'cnpj.required' => 'O cnpj é obrigatório',
            'cnpj.max' => 'O cnpj deve ser igual à 14 caracteres',
            'cnpj.min' => 'O cnpj deve ser igual à 11 caracteres',
            'cnpj.numeric' => 'O cnpj deve ser inteiro'
            


            /*'modelo.required' => 'Mdelo é obrigatório',
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
