<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Marca extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'fornecedor_id'
    ];

    public function fornecedor(){
        return $this->belongsTo(Fornecedor::class);
    }

    public function produtos(){
        return $this->hasMany(Produto::class);
    }
}
