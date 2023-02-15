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
        'complement'
    ];

    public function bairro(){
        return $this->belongsTo(Bairro::class);
    }

    public function pessoa(){
        return $this->belongsTo(Pessoa::class);
    }
}
