<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',

        'complemento',
        'rua',
        'numero',
        'cep',
        'bairro',
        'cidade',

        'telefone',
        'celular',
        'email'
    ];
}
