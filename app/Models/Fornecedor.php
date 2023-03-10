<?php

namespace App\Models;

use App\Models\Pessoa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Pessoa
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'cnpj',
        'email'
    ];

    public function marcas(){
        return $this->hasMany(Marca::class);
    }
}
