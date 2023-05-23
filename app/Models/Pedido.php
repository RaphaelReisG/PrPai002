<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        //'issue_date',
        'payday',
        'delivery_date',
        'approval_date',
        'total_price',
        'total_discount',
        'metodo_pagamento_id',
        'observation',
        'cliente_id',
        'vendedor_id',
        'endereco_id'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function endereco(){
        return $this->belongsTo(Endereco::class);
    }

    public function metodoPagamento(){
        return $this->belongsTo(MetodoPagamento::class);
    }

    public function vendedor(){
        return $this->belongsTo(Vendedor::class);
    }

    public function produtos(){
        return $this->belongsToMany(Produto::class)->withPivot(['qty_item', 'price_item'])->with(['marca', 'marca.fornecedor']);
    }

    public function estoqueable(){
        return $this->morphMany(Estoque::class, 'estoqueable');
    }

    public function criarMovimentacoesEstoque()
    {

    $this->estoqueable()->delete();
    foreach ($this->produtos as $produto) {
        $quantidadeItem = $produto->pivot->qty_item;
        error_log('criando saida estoque - '.$produto->id.' - '.$quantidadeItem);
        $this->estoqueable()->create([
            'produto_id' => $produto->id,
            'qty_item' => $quantidadeItem * (-1),
            'observation' => 'Saída: Pedido confirmado',
            'tipo_movimentacao_id' => 2
            // codigo 2-> venda para um cliente
        ]);
    }
}
}
