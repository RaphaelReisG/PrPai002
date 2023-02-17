<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Usuario_sistema;

class Cliente extends Usuario_sistema
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'cnpj'
    ];

    public function vendedor(){
        return $this->belongsTo(Vendedor::class);
    }

    public function pedidos(){
        return $this->hasMany(Pedido::class)->with(['produtos']);
    }

    public function endereco(){
        return $this->hasOne(Endereco::class)->with(['bairro', 'bairro.cidade', 'bairro.cidade.estado', 'bairro.cidade.estado.pais']);
    }
}
