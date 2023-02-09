<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'idCliente',
        'dataEmissao',
        'dataPagamento',
        'dataEntrega',
        'valor',
        'desconto',
        'formaPagamento',
        'statusPAgamento',
        'statusEntrega',
        'statusSolicitacao',
        'observacao'
    ];
}
