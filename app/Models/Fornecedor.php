<?php

namespace App\Models;

use App\Models\Pessoa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Fornecedor extends Pessoa
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'company_name',
        'cnpj',
        'email'
    ];

    public function marcas(){
        return $this->hasMany(Marca::class);
    }
}
