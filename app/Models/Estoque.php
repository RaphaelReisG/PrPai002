<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'qty_item',
        'observation',
        'tipo_movimentacao_id',
        'produto_id'
        //'batch',                //lote
        //'expiration_date'
    ];

    public function produto(){
        return $this->belongsTo(Produto::class);
    }

    public function tipo_movimentacao(){
        return $this->belongsTo(Tipo_movimentacao::class);
    }

    public function estoqueable(){
        return $this->morphTo();
    }
}
