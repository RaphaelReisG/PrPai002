<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Pessoa extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function telefones(){
        return $this->morphMany(Telefone::class, 'telefoneable');
    }

    public function enderecos(){
        return $this->morphMany(Endereco::class, 'enderecoable')->with(['bairro', 'bairro.cidade', 'bairro.cidade.estado', 'bairro.cidade.estado.pais']);
    }
}
