<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'quantity',
        'weight',
        'cost_price',
        'sale_price',
        'marca_id'
    ];

    public function marca(){
        return $this->belongsTo(Marca::class);
    }

    public function pedidos(){
        return $this->belongsToMany(Pedido::class)
                        ->withPivot(['qty_item', 'price_iten']);
    }

    public function estoques(){
        return $this->hasMany(Estoque::class);
    }

    /*public function totalEstoque(){
        return $this->hasMany(Estoque::class)
            ->sum('qty_item');

        return $this->withSum('estoques', 'qty_item');
    }*/
}
