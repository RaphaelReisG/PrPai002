<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_city'
    ];

    public function estado(){
        return $this->belongsTo(Estado::class)->with(['pais']);
    }

    public function bairros(){
        return $this->hasMany(Bairro::class);
    }
}
