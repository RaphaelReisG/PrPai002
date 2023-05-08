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
        'observation'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function metodoPagamento(){
        return $this->belongsTo(MetodoPagamento::class);
    }

    public function vendedor(){
        return $this->belongsTo(Vendedor::class);
    }

    public function produtos(){
        return $this->belongsToMany(Produto::class)->withPivot(['qty_item', 'price_iten'])->with(['marca']);
    }

    public function estoqueable(){
        return $this->morphMany(Estoque::class, 'estoqueable');
    }
}
