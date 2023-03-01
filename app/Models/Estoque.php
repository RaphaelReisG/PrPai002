<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $fillable = [
        'qty_item',
        'observation',
        'batch',                //lote
        'expiration_date'
    ];

    public function produto(){
        return $this->belongsTo(Produto::class);
    }

    public function estoqueable(){
        return $this->morphTo();
    }
}
