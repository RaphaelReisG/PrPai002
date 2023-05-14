<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = [
        'street_name',
        'cep',
        'house_number',
        'complement',
        'bairro_id',
        'enderecoable_id',
        'enderecoable_type'
    ];

    public function bairro(){
        return $this->belongsTo(Bairro::class)->with(['cidade','cidade.estado', 'cidade.estado.pais']);
    }

    public function enderecoable(){
        return $this->morphTo();
    }
}
