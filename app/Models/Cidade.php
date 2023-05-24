<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cidade extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_city',
        'estado_id'
    ];

    public function estado(){
        return $this->belongsTo(Estado::class)->with(['pais']);
    }

    public function bairros(){
        return $this->hasMany(Bairro::class);
    }
}
