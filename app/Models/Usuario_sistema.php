<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Pessoa;

class Usuario_sistema extends Pessoa
{
    use HasFactory, SoftDeletes;

    public function user(){
        return $this->morphOne(User::class, 'userable');
    }
}
