<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Usuario_sistema;

class Cliente extends Usuario_sistema
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'company_name',
        'cnpj',
        'vendedor_id'
    ];

    public function vendedor(){
        return $this->belongsTo(Vendedor::class);
    }

    public function pedidos(){
        return $this->hasMany(Pedido::class)->with(['produtos']);
    }
}
