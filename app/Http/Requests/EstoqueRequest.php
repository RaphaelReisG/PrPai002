<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstoqueRequest extends FormRequest
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
            'observation' => 'required|max: 45',
            'qty_item' => 'required|integer'
            /*'modelo' => 'required|max:50',
            'ano' => 'required|integer|min:1900',
            'km' => 'required|integer',
            'placa' => 'required|max:7'*/
        ];
    }

    public function messages()
    {
        return [
            'observation.required' => 'É obrigatório ter uma observação',
            'observation.max' => 'A observação deve ter 45 caracteres',

            'qty_item.required' => 'A quantidade é obrigatória',
            'qty_item.integer' => 'A quantidade deve ser inserida em numeros inteiros'


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
