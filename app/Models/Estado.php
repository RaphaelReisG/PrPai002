<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_state',
        'pais_id'
    ];

    public function pais(){
        return $this->belongsTo(Pais::class);
    }

    public function cidades(){
        return $this->hasMany(Cidade::class);
    }
}
