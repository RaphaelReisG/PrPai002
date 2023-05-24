<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Usuario_sistema;

class Administrador extends Usuario_sistema
{
    use HasFactory, SoftDeletes;

    public function estoqueable(){
        return $this->morphMany(Estoque::class, 'estoqueable');
    }
}
