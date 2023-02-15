<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function endereco(){
        return $this->hasOne(Endereco::class);
    }

    public function telefone(){
        return $this->hasOne(Telefone::class);
    }
}
