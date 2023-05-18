<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoRequest extends FormRequest
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
            
            'payday' => 'required|dateTime',
            'delivery_date' => 'required|dateTime',
            'approval_date' => 'required|dateTime',
            'total_price' => 'required|numeric|max:10000',
            'total_discount' => 'required|numeric|max:10000',

            /*'modelo' => 'required|max:50',
            'ano' => 'required|integer|min:1900',
            'km' => 'required|integer',
            'placa' => 'required|max:7'*/
        ];
    }

    public function messages()
    {
        return [
            'name_city.required' => 'Nome é obrigatório',
            'name_city.max' => 'Máximo 45 caracteres no nome',

            'estado_id.required' => 'O ID da cidade é obrigatório',
            'estado_id.integer' => 'O estado deve ser inteiro',

            'total_price.required' => 'O preço total é obrigatório',
            'total_price.numeric' => 'O preço total do produto deve estar no formato decimal',

            'total_discount.required' => 'O desconto total é obrigatório',
            'total_discount.numeric' => 'O desconto total do produto deve estar no formato decimal',
            


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
