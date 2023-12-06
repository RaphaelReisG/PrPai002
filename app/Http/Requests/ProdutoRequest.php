<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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
            'description' => 'max: 200',
            'tipo_produto_id' => 'required|integer',
            'quantity' => 'required|integer|max:1000',
            'weight' => 'required|numeric|max:100',
            'cost_price' => 'required|numeric|max:10000',
            'sale_price' => 'required|numeric|max:10000',
            'file_image' => 'nullable|file|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome do produto é obrigatório',
            'name.max' => 'Máximo 45 caracteres no nome',

            'description.max' => 'Máximo 200 caracteres para descrição',

            'tipo_produto_id.required' => 'O tipo de produto é obrigatório',
            'tipo_produto_id.integer' => 'O tipo de produto deve ser inteiro',

            'quantity.required' => 'A quantidade é obrigatório',
            'quantity.integer' => 'A quantidade do produto deve estar no formato inteiro',

            'weight.required' => 'O peso é obrigatório',
            'weight.decimal' => 'O peso do produto deve estar no formato decimal',

            'cost_price.required' => 'O custo é obrigatório',
            'cost_price.decimal' => 'O custo do produto deve estar no formato decimal',

            'sale_price.required' => 'O preço é obrigatório',
            'sale_price.decimal' => 'O preço do produto deve estar no formato decimal',

            'file_image.max' => 'O tamanho máximo do arquivo é de 10 MB.',
        ];
    }
}
