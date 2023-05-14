<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bairro extends Model
{
    use HasFactory;

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
