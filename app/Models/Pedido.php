<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'issue_date',
        'payday',
        'delivery_date',
        'approval_date',
        'total_price',
        'total_discount',
        'payment_method',
        'observation'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function produtos(){
        return $this->belongsToMany(Produto::class)->withPivot(['qty_item', 'price_iten'])->with(['marca']);
    }
}
