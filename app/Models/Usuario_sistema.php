<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pessoa;

class Usuario_sistema extends Pessoa
{
    use HasFactory;

    public function user(){
        return $this->hasOne(User::class);
    }
}
