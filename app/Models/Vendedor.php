<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Usuario_sistema;

class Vendedor extends Usuario_sistema
{
    use HasFactory;

    public function clientes(){
        return $this->hasMany(Cliente::class);
    }
}
