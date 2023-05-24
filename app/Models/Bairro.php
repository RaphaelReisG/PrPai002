<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bairro extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_neighborhood',
        'cidade_id'
    ];

    public function cidade(){
        return $this->belongsTo(Cidade::class)->with(['estado', 'estado.pais']);
    }

    public function enderecos(){
        return $this->hasMany(Endereco::class);
    }
}
