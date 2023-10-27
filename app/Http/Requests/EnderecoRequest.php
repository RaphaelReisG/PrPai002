<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnderecoRequest extends FormRequest
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
            'street_name' => 'required|max: 45',
            'complement' => 'max: 45',
            'cep' => 'required|integer',
            'house_number' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome é obrigatório',
            'name.max' => 'Máximo 45 caracteres para o nome',

            'street_name.required' => 'Nome da rua é obrigatório',
            'street_name.max' => 'Máximo 45 caracteres para o nome da rua',

            'complement.required' => 'O complemento é obrigatório',
            'complement.max' => 'Máximo 45 caracteres para o complemento',

            'cep.required' => 'O CEP é obrigatório',
            //'cep.max' => 'O cep deve ser ter 11 numeros',
            //'cep.min' => 'O cep deve ser ter 11 numeros',
            'cep.integer' => 'O CEP deve ser inteiro',

            'house_number.required' => 'O número da casa é obrigatório',
            'house_number.integer' => 'O número da casa deve ser inteiro',





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
