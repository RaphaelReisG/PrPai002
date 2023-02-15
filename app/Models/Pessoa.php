<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        
        'number_phone',
        'number_cellphone'
    ];

    public function telefone(){
        return $this->hasOne(Telefone::class);
    }
}
