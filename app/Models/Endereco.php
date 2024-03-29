<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Endereco extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'street_name',
        'cep',
        'house_number',
        'complement',
        'bairro_id',
        'enderecoable_id',
        'enderecoable_type',
        'latitude',
        'longitude'
    ];

    public function bairro(){
        return $this->belongsTo(Bairro::class)->with(['cidade','cidade.estado', 'cidade.estado.pais']);
    }

    public function enderecoable(){
        return $this->morphTo();
    }

    public function pedidos(){
        return $this->hasMany(Pedido::class);
    }
}
